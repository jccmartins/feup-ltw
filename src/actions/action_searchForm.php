<?php
$location = $_GET['location'];
$checkIn = $_GET['checkIn'];
$checkOut = $_GET['checkOut'];
$maxPrice = $_GET['maxPrice'];

header('Location: ../pages/search.php?' 
        . "location=" . $location
        . "&checkIn=" . $checkIn
        . "&checkOut=" . $checkOut
        . "&maxPrice=" . $maxPrice);
?>