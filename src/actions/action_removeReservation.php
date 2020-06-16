<?php
include_once '../database/db_place.php';

// Verifies CSRF token
if ($_SESSION['csrf'] != $_POST['csrf']) {
   //$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
   die(header('Location: ../pages/reservations.php'));
}

$reservation_id = $_POST['reservation_id'];

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Your reservation has been removed successfully!');

removeReservation($reservation_id);
header('Location: ../pages/reservations.php');