<?php
include_once '../includes/session.php';
include_once '../database/db_place.php';
include_once '../templates/tpl_backgrounds.php';
include_once '../templates/tpl_common.php';
include_once '../templates/tpl_manage.php';


// Verify if user is logged in
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  $username = null;
}

$places = getUserPlaces($username);

foreach ($places as $k => $place)
  $places[$k]['photos'] = getPlacePhotos($place['place_id']);

// templates/tpl_backgrounds.php
draw_whiteBackground('My Places');
// templates/tpl_common.php
draw_header($username);
// /templates/tpl_places.php
draw_userPlaces($places);
