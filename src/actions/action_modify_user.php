<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $username = $_SESSION['username'];
  $password = $_POST['password'];
  $newUsername = $_POST['newUsername'];
  $newPassword = $_POST['newPassword'];
  
  if (!checkUserPassword($username, $password)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Password is incorrect.');
    header('Location: ../pages/profile.php');
  }
  else {
    // Don't allow certain characters
  if (!preg_match ("/^[a-zA-Z0-9]+$/", $newUsername)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers.');
    die(header('Location: ../pages/profile.php'));
  } else {
    if (checkIfUsernameExists($newUsername)) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There\'s already an acount with that username.');
      die(header('Location: ../pages/profile.php'));
    } else {
      try {
        modifyUser($username, $newUsername, $newPassword);
        $_SESSION['username'] = $newUsername;
        //$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Username and Password changed!');
        header('Location: ../pages/home.php');
      } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to change username and password!');
        header('Location: ../pages/profile.php');
      }
    }
  }
  }
?>