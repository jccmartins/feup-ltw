<?php function draw_header($username)
{
  /**
   * Draws the header for all pages. Receives an username
   * if the user is logged in in order to draw the logout
   * link.
   */ ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/font.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <header>
    <nav class="topNav" id="myTopnav">
      <?php if ($username != null) { ?>
        <a id="logo" class="active" href="home.php" style="text-decoration:none">Rent-A-Home</a></div>
        <a class="resizable" href="../actions/action_logout.php">Logout</a>
        <a class="resizable" href="profile.php"><?= $username ?></a>
        <a class="resizable" href="reservations.php">My Reservations</a>
        <a class="resizable" href="manage.php">My Places</a>
        <a class="resizable" href="hostHome.php">Host a home</a>
      <?php } else { ?>
        <a id="logo" class="active" href="login.php" style="text-decoration:none">Rent-A-Home</a></div>
        <a class="resizable" href="signup.php">Sign up</a>
        <a class="resizable" href="login.php">Log in</a>
      <?php } ?>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </nav>
  </header>

  <script src="../js/topNav.js"></script>

  </html>

<?php } ?>