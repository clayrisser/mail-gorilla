<?php
/**
  * Mail Gorilla
  * JamRizzi Technologies (c) 2016
  * GNU Public License Version 3
  * Adapted from http://www.w3schools.com/php/func_mail_mail.asp
  */
  
  $name = $_REQUEST['name'];
  $first = $_REQUEST['first'];
  $last = $_REQUEST['last'];
  $email = $_REQUEST['email'];
  $website = $_REQUEST['website'];
  $subject = $_REQUEST['subject'];
  $message = $_REQUEST['message'];
  $success = true;
  
  if (!$name) {
    if ($first) {
      $name = $first;
      if ($last) {
        $name += ' '.$last;
      }
    } else {
      if ($last) {
        $name = $last;
      }
    }
  }
  if (!$name) {
    $success = false;
    echo 'Name does not exist';
  }
  
  if (!$email) {
    $success = false;
    echo 'Email does not exist';
  }
  
  if (!$subject) {
    $subject = 'Email from '.$name;
  }
  
  if ($message) {
    $content = $name.' sent you a message from '.$email.'.';
    if ($website) {
      $content += '\n\nWebsite: '.$website;
    }
    $content += '\n\n'.$message;
  } else {
    $success = false;
    echo 'Message does not exist';
  }

  if ($success) { // Send message
    mail($email, $subject, $content);
    echo 'Yahoo, message sent successfully'.
  }
   
?>