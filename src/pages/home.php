<?php
include_once '../includes/session.php';
include_once '../templates/tpl_backgrounds.php';
include_once '../templates/tpl_common.php';
include_once '../templates/tpl_searchForm.php';

// Verify if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = NULL;
}

// templates/tpl_backgrounds.php
draw_homeBackground("Rent-A-Home");
// templates/tpl_common.php
draw_header($username);
// templates/tpl_searchForm.php
draw_searchForm();
?>