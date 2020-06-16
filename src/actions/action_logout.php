<?php
  include_once('../includes/session.php');
  
  session_destroy();
  session_start();

  //$_SESSION['messages'][] = array('type' => 'success', 'content' => 'You have logged out!');

  header('Location: ../pages/login.php');
?>