<?php 
include_once '../includes/session.php';
include_once '../database/db_place.php';
include_once '../templates/tpl_backgrounds.php';
include_once '../templates/tpl_common.php';
include_once '../templates/tpl_place.php';

$place_id = $_GET['place_id'];

$place = getPlace($place_id);
$place['photos'] = getPlacePhotos($place_id);

// Verify if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = null;
}

// templates/tpl_backgrounds.php
draw_whiteBackground($place['title']);
// templates/tpl_common.php
draw_header($username);
// /templates/tpl_place.php
draw_placePage($place, $username);