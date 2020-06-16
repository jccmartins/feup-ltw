<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Don't allow certain characters
  if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
    die(header('Location: ../pages/signup.php'));
  }

  if (checkIfUsernameExists($username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There\'s already an acount with that username.');
    die(header('Location: ../pages/signup.php'));
  } else {
    try {
      insertUser($username, $password);
      $_SESSION['username'] = $username;
      //$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
      header('Location: ../pages/home.php');
    } catch (PDOException $e) {
      die($e->getMessage());
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
      header('Location: ../pages/signup.php');
    }
  }
?>