<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "employees"; // replace with your database password if any
$dbname = "employees";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create the table if it doesn't exist
$table = "CREATE TABLE IF NOT EXISTS employees (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    birth_date DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    address1 VARCHAR(255) NOT NULL,
    address2 VARCHAR(255),
    country VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    region VARCHAR(50) NOT NULL,
    postal_code VARCHAR(10) NOT NULL
)";

if ($conn->query($table) === TRUE) {
    echo "Table created successfully or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO employees (full_name, email, job_title, phone, birth_date, gender, address1, address2, country, city, region, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $full_name, $email, $job_title, $phone, $birth_date, $gender, $address1, $address2, $country, $city, $region, $postal_code);

// Set parameters and execute
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$birth_date = $_POST['birth_date'];
$gender = $_POST['gender'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$country = $_POST['country'];
$city = $_POST['city'];
$region = $_POST['region'];
$postal_code = $_POST['postal_code'];

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
