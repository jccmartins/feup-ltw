<?php
include_once '../includes/database.php';
include_once '../includes/session.php';

function getSuportedImageTypes()
{
    return array("jpeg", "jpg", "png", "webp");
}

/**
 * Returns the places belonging to a certain user.
 */
function getUserPlaces($username)
{
    $db = Database::instance()->db();
    $user_id = getUserId($username);
    $stmt = $db->prepare('SELECT * FROM place WHERE user_id = ?');
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

/**
 * Returns the places with reservations within check in and check out date in a certain location
 */
function getAvailablePlaces($location, $checkIn, $checkOut, $maxPrice)
{
    $db = Database::instance()->db();

    if (isset($_SESSION['username'])) {
        $user_id = getUserId($_SESSION['username']);
    } else {
        $user_id = NULL;
    }

    $stmt = $db->prepare('SELECT *
                          FROM place
                          WHERE location like ?
                          AND pricePerDay <= ?
                          AND user_id != ?
                          AND place_id NOT IN
                          (
                            SELECT place_id
                            FROM reservation
                            WHERE ((? <= checkOut) AND (? >= checkIn))
                          )  
                          GROUP BY pricePerDay');

    $searchRegExp = "%" . $location . "%";
    $stmt->execute(array($searchRegExp, $maxPrice, $user_id, $checkIn, $checkOut));
    return $stmt->fetchAll();
}

/**
 * Get user_id 
 */
function getUserId($username)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT user_id FROM user WHERE username = ?');
    $stmt->execute(array($username));
    $user_id = array_values($stmt->fetch())[0];
    return $user_id;
}

/**
 * Get username from user_id
 */
function getUsername($user_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username FROM user WHERE user_id = ?');
    $stmt->execute(array($user_id));
    $username = array_values($stmt->fetch())[0];
    return $username;
}

/**
 * Inserts a new place into the database.
 */
function insertPlace($username, $title, $pricePerDay, $location, $description)
{
    $db = Database::instance()->db();
    $user_id = getUserId($username);
    $stmt = $db->prepare('INSERT INTO place VALUES(NULL, ?, ?, ?, ?, ?)');
    $stmt->execute(array($title, $pricePerDay, $location, $description, $user_id));
    return $db->lastInsertId();
}

/**
 * Updates info about a certain place
 */
function updatePlace($place_id, $title, $pricePerDay, $location, $description)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE place 
    SET title = ?, pricePerDay = ?, location = ?, description = ?
    WHERE place_id = ?');
    $stmt->execute(array($title, $pricePerDay, $location, $description, $place_id));
}


/**
 * Removes a certain place
 */
function removePlace($place_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM reservation WHERE place_id = ?');
    $stmt->execute(array($place_id));
    $stmt = $db->prepare('DELETE FROM photo WHERE place_id = ?');
    $stmt->execute(array($place_id));
    $stmt = $db->prepare('DELETE FROM chat WHERE place_id = ?');
    $stmt->execute(array($place_id));

    $photos_folder = "../images/uploads/" . $place_id;
    $photos_path = "../images/uploads/" . $place_id . "/*";

    $files = glob($photos_path); // get all file names

    foreach ($files as $file) { // iterate files
        if (is_file($file))
            unlink($file); // delete file
    }

    rmdir($photos_folder);

    $stmt = $db->prepare('DELETE FROM place WHERE place_id = ?');
    $stmt->execute(array($place_id));
}

/**
 * Removes photos of place with place_id
 */
function removePhotos($place_id)
{

    $db = Database::instance()->db();

    $place_photos = getPlacePhotos($place_id);

    if (isset($_POST['imagesSrc'])) {

        // Count number of input with value with an image source in array
        $total = count($_POST['imagesSrc']);

        // Loop through each 
        foreach ($place_photos as $photo) {

            $removePhoto = true;

            for ($i = 0; $i < $total; $i++) {
                if ($_POST["imagesSrc"][$i] == $photo['url']) {
                    $removePhoto = false;
                }
            }

            if ($removePhoto == true) {
                $stmt = $db->prepare('DELETE FROM photo WHERE url = ?');
                $stmt->execute(array($photo['url']));
                unlink($photo['url']);
                echo "The file " . $photo['url'] . " has been removed";
                echo "<br>";
            }
        }
    } else {
        // Loop through each 
        foreach ($place_photos as $photo) {
            $stmt = $db->prepare('DELETE FROM photo WHERE url = ?');
            $stmt->execute(array($photo['url']));
            unlink($photo['url']);
            echo "The file " . $photo['url'] . " has been removed";
            echo "<br>";
        }
    }
}

/**
 * Inserts new photos of place with place_id and uploads them to ../images/uploads/$place_id
 */
function insertPhotos($place_id)
{
    $db = Database::instance()->db();

    $photosInserted = false;

    // Count number of uploaded files in array
    // subtract 1 because the last input is empty (it's the input to add another photo)
    $total = count($_FILES['photos']['name']) - 1;

    // Loop through each file
    for ($i = 0; $i < $total; $i++) {

        $stmt = $db->prepare('INSERT INTO photo VALUES(NULL, "", ?)');
        $stmt->execute(array($place_id));
        $photo_id = $db->lastInsertId();

        // File Info
        $temp_list = explode(".", $_FILES["photos"]["name"][$i]);
        $imageFileType = $temp_list[count($temp_list) - 1];
        list($mime_type, $mime_subtype) = explode("/", mime_content_type($_FILES["photos"]["tmp_name"][$i]));

        $target_dir = "../images/uploads/$place_id/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . $photo_id . "." . $imageFileType;
        $uploadOk = 1;
        // Check if image file is a actual image or fake image

        if ($mime_type == "image" && array_search($mime_subtype, getSuportedImageTypes()) !== false && array_search($imageFileType, getSuportedImageTypes()) !== false) {
            $check = getimagesize($_FILES["photos"]["tmp_name"][$i]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.<br>";
                $uploadOk = 0;
            }
        } else {
            $uploadOk = 0;
            echo "File type not supported.<br>";
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // // Check file size
        //         if ($_FILES["photos"]["size"][$i] > 500000) {
        //             echo "Sorry, your file is too large.";
        //             $uploadOk = 0;
        //         }
        // // Allow certain file formats (also did accept="image/*" in input)
        //         if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        //             && $imageFileType != "gif") {
        //             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //             $uploadOk = 0;
        //         }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $stmt = $db->prepare('DELETE FROM photo
                                    WHERE photo_id = ?');
            $stmt->execute(array($photo_id));
            echo "Sorry, your file was not uploaded.";
        }
        // if everything is ok, try to upload file
        else {
            if (move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file)) {
                $stmt = $db->prepare('UPDATE photo
                                    SET url = ?
                                    WHERE photo_id = ?');
                $stmt->execute(array($target_file, $photo_id));
                echo "The file " . basename($_FILES["photos"]["name"][$i]) . " has been uploaded.";
                $photosInserted = true;
            } else {
                $stmt = $db->prepare('DELETE FROM photo
                                    WHERE photo_id = ?');
                $stmt->execute(array($photo_id));
                echo "Sorry, there was an error uploading your file.";
            }
        }

        echo "<br>";
    }

    return $photosInserted;
}

/**
 * Get all reservations in a place
 */
function getPlaceReservations($place_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM reservation WHERE ? = place_id GROUP BY checkIn');
    $stmt->execute(array($place_id));
    return $stmt->fetchAll();
}

/**
 * Returns a certain place from the database.
 */
function getPlace($place_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM place WHERE place_id = ?');
    $stmt->execute(array($place_id));
    return $stmt->fetch();
}

/**
 * Returns the username of a certain place owner
 */
function getPlaceOwner($place)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username FROM user WHERE user_id = ?');
    $stmt->execute(array($place['user_id']));
    return $stmt->fetch();
}

/**
 * Return all the photos from a certain place
 */
function getPlacePhotos($place_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM photo WHERE place_id = ?');
    $stmt->execute(array($place_id));
    return $stmt->fetchAll();
}

/**
 * Add reservation to the database
 */
function addReservation($guest_id, $checkIn, $checkOut, $place_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO reservation VALUES(NULL, ?, ?, ?, ?)');
    $stmt->execute(array($guest_id, $checkIn, $checkOut, $place_id));
}

/**
 * Removes reservation from the database
 */
function removeReservation($reservation_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM reservation WHERE reservation_id = ?');
    $stmt->execute(array($reservation_id));
}

function getUserReservatons($username)
{
    $db = Database::instance()->db();
    $user_id = getUserId($username);
    $stmt = $db->prepare('SELECT * FROM reservation WHERE guest_id = ?');
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}
