<?php
/**
  * Mail Gorilla
  * JamRizzi Technologies (c) 2016
  * GNU Public License Version 3
  */
  
  $name = isset($_REQUEST["name"]) && strlen($_REQUEST["name"]) > 0 ? $_REQUEST["name"] : null;
  $first = isset($_REQUEST["first"]) && strlen($_REQUEST["first"]) > 0 ? $_REQUEST["first"] : null;
  $last = isset($_REQUEST["last"]) && strlen($_REQUEST["last"]) > 0 ? $_REQUEST["last"] : null;
  $email = isset($_REQUEST["email"]) && strlen($_REQUEST["email"]) > 0 ? $_REQUEST["email"] : null;
  $website = isset($_REQUEST["website"]) && strlen($_REQUEST["website"]) > 0 ? $_REQUEST["website"] : null;
  $subject = isset($_REQUEST["subject"]) && strlen($_REQUEST["subject"]) > 0 ? $_REQUEST["subject"] : null;
  $message = isset($_REQUEST["message"]) && strlen($_REQUEST["message"]) > 0 ? $_REQUEST["message"] : null;
  $success = true;
  $status = "";
  
  if (!$name) {
    if ($first) {
      $name = $first;
      if ($last) {
        $name .= " $last";
      }
    } else {
      if ($last) {
        $name = $last;
      }
    }
  }
  if (!$name) {
    $success = false;
    $status .= "Name does not exist. ";
  }
  
  if (!$email) {
    $success = false;
    $status .= "Email does not exist. ";
  }
  
  if (!$subject) {
    $subject = "Email from $name";
  }
  
  if ($message) {
    $content = "$name sent you a message from $email.\n";
    if ($website) {
      $content .= "Website: $website\n";
    }
    $content .= "$message";
  } else {
    $success = false;
    $status .= "Message does not exist. ";
  }

  if ($success) { // Send message
    $sent = mail($email, $subject, $content);
    if ($sent) { // Mail sent successfully
      $status .= "Yahoo, message sent successfully.";
    } else { // Mail failed to send
      $status .= "Message failed to send.";
      $success = false;
    }
  } else { // Parameters not set
    $response->success = $success;
  }
  
  $response->success = $success;
  $response->status = $status;
  
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  echo json_encode($response);
  
?>
