<?php 
  include_once '../includes/session.php';
  include_once '../templates/tpl_backgrounds.php';
  include_once '../templates/tpl_common.php';
  include_once '../templates/tpl_profile.php';

  // Verify if user is logged in
  if (!isset($_SESSION['username']))
    die(header('Location: login.php'));

  // templates/tpl_backgrounds.php
  draw_homeBackground("Profile");
  // /templates/tpl_common.php
  draw_header($_SESSION['username']);

  draw_profile($_SESSION['username']);
?>