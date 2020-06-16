<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($username, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
  }

    /**
   * Verifies if an account with the username already exists
   */
  function checkIfUsernameExists($username) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();
    return $user !== false;
  }
  
  function insertUser($username, $password) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO user VALUES(NULL, ?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options)));
  }

  function modifyUser($username, $newUsername, $newPassword) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('UPDATE user SET username = ?, password = ? WHERE username == ?');
    $stmt->execute(array($newUsername, password_hash($newPassword, PASSWORD_DEFAULT, $options), $username));
  }
?>