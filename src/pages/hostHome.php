<?php
include_once '../includes/session.php';
include_once '../templates/tpl_hostHome.php';
include_once '../templates/tpl_common.php';

// Verify if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    die(header('Location: login.php'));
}

draw_header($username);
// templates/tpl_hostHome.php;
draw_hostHomeForm();
?>
