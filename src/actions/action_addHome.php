<?php
include_once '../includes/session.php';
include_once '../database/db_place.php';

// Verify if user is logged in
if (!isset($_SESSION['username'])) {
    die(header('Location: ../pages/login.php'));
}

$regex = "/[^a-záàâãéèêíïóôõöúçñ0-9\s.\-'!\?,\/+]+$/im";
// "/[^a-zA-Z\s'\t\n\r,\.]/"

$username = $_SESSION['username'];
$title = preg_replace ($regex, '', $_POST['title']);
$pricePerDay = preg_replace ("/[^0-9]/", '', $_POST['pricePerDay']);
$location = preg_replace ($regex, '', $_POST['location']);
$description = preg_replace ($regex, '', $_POST['description']);

$place_id = insertPlace($username, $title, $pricePerDay, $location, $description);
if(insertPhotos($place_id) == false){
    removePlace($place_id);
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Your place was not added due to no valid photos!');
}else{
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Your place has been added successfully!');
}

header('Location: ../pages/manage.php');
?>