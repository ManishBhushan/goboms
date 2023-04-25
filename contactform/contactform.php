<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  // Check if all fields are filled
  if ($name == "" OR $email == "" OR $subject == "" OR $message == "") {
    http_response_code(400);
    echo json_encode(array("message" => "All fields are required."));
    exit;
  }

  // Check if the email address is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid email address."));
    exit;
  }

  // Set the recipient email address
  $to = "info@goboms.com";

  // Set the email subject
  $subject = "New message from your website: $subject";

  // Build the email message
  $email_message = "Name: $name\n";
  $email_message .= "Email: $email\n";
  $email_message .= "Subject: $subject\n";
  $email_message .= "Message:\n$message\n";

  // Set the email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send the email
  if (mail($to, $subject, $email_message, $headers)) {
    http_response_code(200);
    echo json_encode(array("message" => "Thank you for contacting us! We will get back to you as soon as possible!"));
  } else {
    http_response_code(400);
    echo json_encode(array("message" => "There was an error sending your message! Please try again!"));
  }

} else {
  // If the form was not submitted, redirect to the homepage or show an error message.
  header("Location: https://goboms.netlify.app/");
  exit;
}

