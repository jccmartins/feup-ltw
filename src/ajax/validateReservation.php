<?php
include_once '../database/db_place.php';

$place_id = $_POST['place_id'];
$checkIn = $_POST['checkIn'];
$checkOut = $_POST['checkOut'];

$db = Database::instance()->db();
$stmt = $db->prepare('SELECT checkIn, checkOut FROM reservation WHERE place_id = ?');
$stmt->execute(array($place_id));
$reservationDates = $stmt->fetchAll();

foreach ($reservationDates as $dates) {
    $db_checkIn = $dates['checkIn'];
    $db_checkOut = $dates['checkOut'];

    if (($db_checkIn <= $checkOut) && ($db_checkOut >= $checkIn)) {
        echo "Dates are already booked!";
        break;
    }
}

echo "";
