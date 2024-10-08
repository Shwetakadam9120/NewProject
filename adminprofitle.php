<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "user_profiles";
$dbname = "user_profile_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
    $mobileNumber = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $facebook = isset($_POST['facebook']) ? $_POST['facebook'] : '';
    $linkedin = isset($_POST['linkedin']) ? $_POST['linkedin'] : '';
    $instagram = isset($_POST['instagram']) ? $_POST['instagram'] : '';
    $oldPassword = isset($_POST['oldPassword']) ? $_POST['oldPassword'] : '';
    $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';

    // Check if new passwords match
    if ($newPassword !== $confirmPassword) {
        die("New passwords do not match.");
    }

    // Handle file upload
    $uploadDir = 'uploads/';
    $fileDestination = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileName = basename($_FILES['file']['name']);
        $fileDestination = $uploadDir . $fileName;

        if (!move_uploaded_file($fileTmpName, $fileDestination)) {
            echo "Error uploading file.";
            $fileDestination = ''; // Clear file destination if upload fails
        }
    } elseif (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "Error with file upload: " . $_FILES['file']['error'];
        $fileDestination = ''; // Clear file destination if there is an error
    }

    // Hash the new password if provided
    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    } else {
        // Fetch the existing password if the new one is not provided
        $result = $conn->query("SELECT password FROM users WHERE email='$email'");
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];
    }

    // Prepare SQL statement
    $sql = "UPDATE users 
            SET firstName=?, lastName=?, phoneNumber=?, mobileNumber=?, email=?, facebook=?, linkedin=?, instagram=?, profilePhoto=?, password=? 
            WHERE email=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters to the SQL query
    $stmt->bind_param("sssssssssss", $firstName, $lastName, $phoneNumber, $mobileNumber, $email, $facebook, $linkedin, $instagram, $fileDestination, $hashedPassword, $email);

    // Execute the SQL query
    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . htmlspecialchars($stmt->error);
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
