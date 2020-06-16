<?php
  include_once '../includes/database.php';

  $location = $_GET['location'];

  // Database connection
  $db = Database::instance()->db();
  
  // Get the countries that start with $name
  $stmt = $db->prepare("SELECT * FROM place WHERE upper(location) LIKE upper(?) GROUP BY location LIMIT 3");
  $stmt->execute(array("$location%"));
  $locations = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($locations);
?>
