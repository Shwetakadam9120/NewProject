<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "employees"; // Default XAMPP MySQL password is empty
$dbname = "empledit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST['employeeId'];
    $bankAccountName = $_POST['bankAccountName'];
    $bankAccountNumber = $_POST['bankAccountNumber'];
    
    // Handling file upload
    $bankDocument = $_FILES['bankUpload']['name'];
    $target_dir = "uploads/";

    // Check if the uploads directory exists, create it if not
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($bankDocument);

    if (move_uploaded_file($_FILES["bankUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($bankDocument)) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // SQL query to insert data into the bank_accounts table
    $sql = "INSERT INTO bank_accounts (employee_id, bank_account_name, bank_account_number, bank_document) 
            VALUES ('$employeeId', '$bankAccountName', '$bankAccountNumber', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "Bank account details added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
