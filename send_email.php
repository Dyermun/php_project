<?php
// send_email.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        header('Location: index.php?status=error&message=Please fill all required fields');
        exit;
    }

    // Process the email (this is a basic example)
    $to = "reymundgandamon2@gmail.com";
    $headers = "From: $email";
    $emailSubject = "New Contact Form Submission: $subject";
    $emailBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $emailSubject, $emailBody, $headers)) {
        header('Location: index.php?status=success&message=Thank you! Your message has been sent.');
    } else {
        header('Location: index.php?status=error&message=Sorry, there was an error sending your message.');
    }
    exit;
}

header('Location: index.php');
exit;
