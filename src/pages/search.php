<?php 
include_once '../includes/session.php';
include_once '../database/db_place.php';
include_once '../templates/tpl_backgrounds.php';
include_once '../templates/tpl_common.php';
include_once '../templates/tpl_places.php';

$location = $_GET['location'];
$checkIn = $_GET['checkIn'];
$checkOut = $_GET['checkOut'];
$maxPrice = $_GET['maxPrice'];

list($year_In, $month_In, $day_In) = explode("-", $checkIn);
list($year_Out, $month_Out, $day_Out) = explode("-", $checkOut);

if($year_In > $year_Out){
  die(header("Location: ./notFound.html"));
} 
else if($year_In == $year_Out && $month_In > $month_Out){
  die(header("Location: ./notFound.html"));
}
else if($year_In == $year_Out && $month_In == $month_Out && $day_In >= $day_Out){
  die(header("Location: ./notFound.html"));
}

$places = getAvailablePlaces($location, $checkIn, $checkOut, $maxPrice);

foreach ($places as $k => $place)
  $places[$k]['photos'] = getPlacePhotos($place['place_id']);

// Verify if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = null;
}

// templates/tpl_backgrounds.php
draw_whiteBackground('Search');
// templates/tpl_common.php
draw_header($username);
// /templates/tpl_places.php
draw_places($places, $location);