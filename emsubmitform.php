<?php
// Database connection settings
$host = 'localhost'; // Change if your MySQL is hosted elsewhere
$dbname = 'employee_management';
$username = 'your_username'; // Replace with your MySQL username
$password = 'your_password'; // Replace with your MySQL password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    echo "New employee registered successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
