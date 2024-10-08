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

// SQL to create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id VARCHAR(50) NOT NULL,
    employee_name VARCHAR(100) NOT NULL,
    department_name VARCHAR(100) NOT NULL,
    profile_image VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table employees created successfully or already exists<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];
    $departmentName = $_POST['departmentName'];
    
    // Handling file upload
    $profileImage = $_FILES['profile-image']['name'];
    $target_dir = "uploads/";

    // Check if the uploads directory exists, create it if not
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($profileImage);

    if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($profileImage)) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // SQL query to insert data into the employees table
    $sql = "INSERT INTO employees (employee_id, employee_name, department_name, profile_image) 
            VALUES ('$employeeId', '$employeeName', '$departmentName', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

