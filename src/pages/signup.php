<?php 
  include_once '../includes/session.php';
  include_once '../templates/tpl_backgrounds.php';
  include_once '../templates/tpl_common.php';
  include_once '../templates/tpl_auth.php';

  // Verify if user is logged in
  if (isset($_SESSION['username']))
    die(header('Location: home.php'));

  // templates/tpl_backgrounds.php
  draw_homeBackground("Sign up");
  // /templates/tpl_common.php
  draw_header(null);
  // /templates/tpl_auth.php
  draw_signup();
?>