<?php
include_once '../templates/tpl_updateHome.php';
include_once '../database/db_place.php';
include_once '../templates/tpl_hostHome.php';
include_once '../templates/tpl_common.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    die(header('Location: login.php'));
}

$place_id = $_GET['place_id'];
$place = getPlace($place_id);
$photos = getPlacePhotos($place_id);

draw_header($username);
// templates/tpl_updateHome.php;
draw_updateHomeForm($place['place_id'], $place['title'], $place['pricePerDay'], $place['location'], $place['description'], $photos);
