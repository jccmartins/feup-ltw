<?php function draw_login()
{
  /**
   * Draws the login section.
   */ ?>

  <head>
    <link href="../css/form.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <form id="login" method="post" action="../actions/action_login.php">
    <header>
      <h2>Log in</h2>
    </header>
    <?php if (isset($_SESSION['messages'])) { ?>
      <h4 id="messages">
        <?php foreach ($_SESSION['messages'] as $message) { ?>
          <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
        <?php } ?>
      </h4>
    <?php unset($_SESSION['messages']);
                                            } ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input id="button" type="submit" value="Login">
    <h1>Don't have an account? <a href="signup.php" style="text-decoration:none">Sign up</a></h1>
  </form>

<?php }

                                          function draw_signup()
                                          {
                                            /**
                                             * Draws the signup section.
                                             */ ?>

  <head>
    <link href="../css/form.css" rel="stylesheet">
  </head>

  <form id="signup" method="post" action="../actions/action_signup.php">
    <header>
      <h2>Sign up</h2>
    </header>
    <?php if (isset($_SESSION['messages'])) { ?>
      <h4 id="messages">
        <?php foreach ($_SESSION['messages'] as $message) { ?>
          <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
        <?php } ?>
      </h4>
    <?php unset($_SESSION['messages']);
                                            } ?>
    <input type="text" id="username" name="username" placeholder="Username" required>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <input id="button" type="submit" value="Create account">
    <h1>Already have an account? <a href="login.php" style="text-decoration:none">Log in</a></h1>
  </form>

<?php }
