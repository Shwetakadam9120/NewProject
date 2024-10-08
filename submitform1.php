<?php
// submitform.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job_title = $_POST['job_title'];
    $gender = $_POST['gender'];
    $address = $_POST['address1'] . ' ' . $_POST['address2'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $postal_code = $_POST['postal_code'];
    $status = 'status-active'; // Assuming new entries are active by default

    // Normally, you'd save this to a database and then fetch it to display
    // For demonstration, we will echo out a new table row

    echo "<tr>
        <td>{$name}</td>
        <td>{$email}</td>
        <td>{$phone}</td>
        <td>{$job_title}</td>
        <td><a href='empldit.html'>Edit</a></td>
        <td><a href='tviewprofile.html'>View</a></td>
        <td><span class='status-circle {$status}'></span></td>
    </tr>";
}
?>
