<?php
/**
  * Mail Gorilla
  * JamRizzi Technologies (c) 2016
  * GNU Public License Version 3
  * Adapted from http://www.w3schools.com/php/func_mail_mail.asp
  */
  
  $name = isset($_REQUEST["name"]) && strlen($_REQUEST["name"]) > 1 ? $_REQUEST["name"] : null;
  $first = isset($_REQUEST["first"]) && strlen($_REQUEST["first"]) > 1 ? $_REQUEST["first"] : null;
  $last = isset($_REQUEST["last"]) && strlen($_REQUEST["last"]) > 1 ? $_REQUEST["last"] : null;
  $email = isset($_REQUEST["email"]) && strlen($_REQUEST["email"]) > 1 ? $_REQUEST["email"] : null;
  $website = isset($_REQUEST["website"]) && strlen($_REQUEST["website"]) > 1 ? $_REQUEST["website"] : null;
  $subject = isset($_REQUEST["subject"]) && strlen($_REQUEST["subject"]) > 1 ? $_REQUEST["subject"] : null;
  $message = isset($_REQUEST["message"]) && strlen($_REQUEST["message"]) > 1 ? $_REQUEST["message"] : null;
  $success = true;
  
  if (!$name) {
    if ($first) {
      $name = $first;
      if ($last) {
        $name += " $last";
      }
    } else {
      if ($last) {
        $name = $last;
      }
    }
  }
  if (!$name) {
    $success = false;
    echo "Name does not exist.\n";
  }
  
  if (!$email) {
    $success = false;
    echo "Email does not exist.\n";
  }
  
  if (!$subject) {
    $subject = "Email from $name";
  }
  
  if ($message) {
    $content = "$name sent you a message from $email.\n";
    if ($website) {
      $content += "Website: $website\n";
    }
    $content += "$message";
  } else {
    $success = false;
    echo "Message does not exist.\n";
  }

  if ($success) { // Send message
    mail($email, $subject, $content);
    echo "Yahoo, message sent successfully";
  }
   
?>