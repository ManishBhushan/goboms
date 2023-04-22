<!-- <php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $subject = str_replace(array("\r","\n"),array(" "," "),$subject);
  $message = trim($_POST["message"]);
  
  $recipient = "info@goboms.com";
  $headers = "From: " . $name . " <" . $email . ">\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  
  mail($recipient, $subject, $message, $headers);
}
?> -->


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  // Check if all fields are filled
  if ($name == "" OR $email == "" OR $subject == "" OR $message == "") {
    echo "All fields are required.";
    exit;
  }

  // Check if the email address is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
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
    echo "OK";
  } else {
    echo "Something went wrong. Please try again later.";
  }

} else {
  // If the form was not submitted, redirect to the homepage or show an error message.
  header("Location: https://goboms.netlify.app/");
  exit;

}
?>
