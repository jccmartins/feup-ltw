<?php
include_once '../includes/session.php';
include_once '../database/db_place.php';

// Verifies CSRF token
if ($_SESSION['csrf'] != $_POST['csrf']) {
    //$_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
    die(header('Location: ../pages/place.php?place_id=' . $place_id));
}

// Verify if user is logged in
if (!isset($_SESSION['username'])) {
    die(header('Location: ../pages/login.php'));
}

$regex = "/[^a-záàâãéèêíïóôõöúçñ0-9\s.\-'!\?,\/+]+$/im";

$place_id = $_POST['place_id'];

$title = preg_replace($regex, '', $_POST['title']);
$pricePerDay = preg_replace("/[^0-9]/", '', $_POST['pricePerDay']);
$location = preg_replace($regex, '', $_POST['location']);
$description = preg_replace($regex, '', $_POST['description']);

$number_placePhotos = count(getPlacePhotos($place_id));

if (isset($_POST['imagesSrc'])) {
    $number_photosRemoved = count(getPlacePhotos($place_id)) - count($_POST['imagesSrc']);
} else {
    $number_photosRemoved = count(getPlacePhotos($place_id));
}

removePhotos($place_id);

//if no new photos are inserted and all old photos are removed
if (insertPhotos($place_id) == false && $number_photosRemoved == $number_placePhotos) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Your place wasn\'t updated because it has no photos (or invalid files)!');
} else {
    updatePlace($place_id, $title, $pricePerDay, $location, $description);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Your place has been updated successfully!');
}

header('Location: ../pages/place.php?place_id=' . $place_id);
