<?php
include_once '../includes/session.php';
include_once '../database/db_place.php';

// Verify if user is logged in
if (!isset($_SESSION['username'])) {
    die(header('Location: ../pages/login.php'));
}

$username = $_SESSION['username'];
$guest_id = getUserId($username);
$place_id = $_POST['place_id'];
$checkIn = $_POST['checkIn'];
$checkOut = $_POST['checkOut'];

addReservation($guest_id, $checkIn, $checkOut, $place_id);

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'The reservation been added successfully!');

header('Location: ../pages/reservations.php');
