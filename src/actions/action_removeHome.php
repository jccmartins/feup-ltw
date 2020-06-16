<?php
include_once '../includes/session.php';
include_once '../database/db_place.php';

// Verifies CSRF token
if ($_SESSION['csrf'] != $_GET['csrf']) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request!');
    die(header('Location: ../pages/manage.php'));
}

$place_id = $_GET['place_id'];

removePlace($place_id);

$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Your place has been removed successfully!');    

die(header('Location: ../pages/manage.php'));
