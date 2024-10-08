<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Basic validation (you can enhance this)
    if (!empty($fullname) && !empty($email) && !empty($message)) {
        // Example of processing: send an email
        $to = "sales@virajo.in";
        $subject = "New Contact Form Submission";
        $body = "Name: $fullname\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            // Redirect to a thank you page upon success
            header("Location: thank_you.html");
            exit();
        } else {
            // Handle failure in sending email
            echo "Failed to send the message.";
        }
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request.";
}
?>
