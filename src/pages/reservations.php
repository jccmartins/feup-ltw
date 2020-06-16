<?php
include_once '../includes/session.php';
include_once '../database/db_place.php';
include_once '../templates/tpl_backgrounds.php';
include_once '../templates/tpl_common.php';
include_once '../templates/tpl_reservations.php';


// Verify if user is logged in
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  $username = null;
}

$reservations = getUserReservatons($username);

foreach ($reservations as $k => $place)
  $reservations[$k]['photos'] = getPlacePhotos($place['place_id']);

// templates/tpl_backgrounds.php
draw_whiteBackground('My Reservations');
// templates/tpl_common.php
draw_header($username);
// /templates/tpl_reservations.php
draw_userReservations($reservations);
