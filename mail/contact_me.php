<?php
// Check for empty fields
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "No arguments Provided!";
    return false;
}

$name = htmlspecialchars(trim($_POST['name']));
$email_address = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(trim($_POST['phone']));
$message = htmlspecialchars(trim($_POST['message']));

// Validate sanitized email
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format!";
    return false;
}

// Create the email and send the message
$to = 'info@turcexport.com'; 
$email_subject = "Website Contact Form: $name";
$email_body = "You have received a new message from your website contact form.\n\nHere are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@turcexport.com\r\n";
$headers .= "Reply-To: $email_address\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $email_subject, $email_body, $headers)) {
    echo "Message sent successfully!";
} else {
    echo "Failed to send message.";
}
return true;
?>
