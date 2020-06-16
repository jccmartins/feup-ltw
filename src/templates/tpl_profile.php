<?php function draw_profile($username)
{
  /**
   * Draws the profile section.
   */ ?>

  <head>
    <link href="../css/form.css" rel="stylesheet">
  </head>

  <form id="profile" action="../actions/action_modify_user.php" method="post">
    <header>
      <h2><?= $username ?>'s Profile</h2>
    </header>
    <?php if (isset($_SESSION['messages'])) { ?>
      <h4 id="messages">
        <?php foreach ($_SESSION['messages'] as $message) { ?>
          <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
        <?php } ?>
      </h4>
    <?php unset($_SESSION['messages']);
      } ?>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="newUsername" placeholder="New username" required>
    <input type="password" name="newPassword" placeholder="New password" required>
    <input id="button" type="submit" value="Change username and password">
  </form>

<?php } ?>