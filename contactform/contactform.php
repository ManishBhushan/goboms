<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $subject = str_replace(array("\r","\n"),array(" "," "),$subject);
  $message = trim($_POST["message"]);
  
  $recipient = "n.manishbhushan@gmail.com";
  $headers = "From: " . $name . " <" . $email . ">\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  
  mail($recipient, $subject, $message, $headers);
}
?>