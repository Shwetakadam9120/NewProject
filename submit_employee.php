<?php
// submitform.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $department = htmlspecialchars($_POST['department']);
    $status = htmlspecialchars($_POST['status']);

    // Start the session and store the data
    session_start();
    if (!isset($_SESSION['employees'])) {
        $_SESSION['employees'] = [];
    }
    $_SESSION['employees'][] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'department' => $department,
        'status' => $status
    ];

    // Redirect to the table page
    header('Location: empltable.php'); // Ensure this is a PHP file
    exit();
}
?>
