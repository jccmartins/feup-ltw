<?php include_once '../database/db_place.php'; ?>

<?php function draw_placePage($place, $username)
{
  /**
   *  Draw place page. Expects $place to have
   * place_id, title, pricePerDay, location,
   * description, user_id and photos fields.
   */
?>

  <head>
    <link href="../css/placePage.css" rel="stylesheet">
    <link href="../css/modal.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../ajax/comments.js" defer></script>
  </head>

<?php
  draw_place($place, $username);
} ?>

<?php function draw_place($place, $username)
{
  /**
   * Draws the place section.
   */ ?>

  <section id="place">

    <div id="container">
      <div class="image">
        <img src="<?= $place['photos'][0]['url']; ?>" alt="Error showing image">
        <button type="button" id="morePhotos" onclick="openModal();">More Photos</button>
      </div>

      <!-- The Modal/Lightbox -->
      <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content">

          <?php
                  foreach ($place['photos'] as $k => $photo) { ?>
            <div class="mySlides">
              <div class="numbertext"><?= $k + 1 ?> / <?= sizeof($place['photos']) ?></div>
              <?php draw_photo($photo); ?>
            </div>
          <?php } ?>

          <!-- Next/previous controls -->
          <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
          <button class="next" onclick="plusSlides(1)">&#10095;</button>

        </div>
      </div>

      <?php if (isset($_SESSION['messages'])) { ?>
        <h4 id="messages">
          <?php foreach ($_SESSION['messages'] as $message) { ?>
            <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
          <?php } ?>
        </h4>
      <?php unset($_SESSION['messages']);
                                                    } ?>

      <?php $owner = getPlaceOwner($place); ?>
      <div class="desc">
        <h2 id="title"><?= $place['title'] ?> </h2>
        <h3 id="location"><?= $place['location'] ?> </h3>
        <h4 id="description"><?= nl2br($place['description']); ?></h4>
        <h4 id="€night"> € / night</h4>
        <h4 id="price"><?= $place['pricePerDay'] ?></h4>
        <h4 id="owner">By: <?= $owner['username'] ?></h2>
      </div>

      <?php $reservations = getPlaceReservations($place['place_id']); ?>

      <div id="listReservations">

        <h3 id="reservations">List of Reservations</h3>

        <?php if (count($reservations) == 0) { ?>
          <h4> No reservations yet. </h4>
        <?php } else { ?>
          <div id="columnIdentifiers">
            <h4 id="guestWord">Guest</h4>
            <h4 id="datesWord">Check-in -> Check-Out</h4>
          </div>
        <?php foreach ($reservations as $reservation) {
                                                        draw_reservation($reservation);
                                                      }
                                                    } ?>
      </div>

      <?php if ($username != getPlaceOwner($place)['username']) { ?>
        <div id="reservation">
          <form id="reservationForm" method="post" action="../actions/action_reserve.php">
            <input id="place_id" type='hidden' name='place_id' value='<?= $place['place_id'] ?>' />
            <div id="checkIn">
              <label>Check-In</label>
              <input id="checkIn" type="date" name="checkIn" required="required" onchange="updateMinMax(0); setTotalPrice(<?= $place['pricePerDay'] ?>); clearMessage();">
            </div>
            <div id="checkOut">
              <label>Check-Out</label>
              <input id="checkOut" type="date" name="checkOut" required="required" onchange="updateMinMax(1); setTotalPrice(<?= $place['pricePerDay'] ?>); clearMessage();">
            </div>
            <p id="totalPrice"></p>
            <p id="message"></p>
            <?php ?>
            <input id="button" name="bookButton" type="button" value="Book">
          </form>
        </div>

        <script type="text/javascript">
          document.getElementsByTagName("input")[name = "bookButton"].onclick = function() {
            if (areDatesValid()) {
              validateDates();
            }
          };
        </script>

      <?php }

                                                                                                                          if ($username == getPlaceOwner($place)['username']) { ?>
        <div id="placeOptions">
          <div id="editPlace">
            <button id="edit">Edit Place</button>

          </div>

          <div id="removePlace">
            <button id="remove">Remove Place</button>
          </div>
        </div>
        <script type="text/javascript">
          document.getElementById("edit").onclick = function() {
            location.href = "../pages/updateHome.php?place_id=" + "<?= $place['place_id'] ?>";
          };
          document.getElementById("remove").onclick = function() {
            location.href = "../actions/action_removeHome.php?place_id=" + "<?= $place['place_id'] ?>&csrf=<?= $_SESSION['csrf'] ?>";
          };
        </script>
      <?php } ?>

      <div id="comments">
        <h3>Comments </h3>
        <div id="chat"></div>
        <form id="chatForm">
          <input type="hidden" name="username" value="<?= $username ?> ">
          <input type="hidden" name="place_id" value="<?= $place['place_id'] ?> ">
          <input type="text" name="message" placeholder="Say something nice about this place" pattern="[a-zA-Z\s.\-'!\?/]+">
          <input id="button" type="submit" value="Comment">
        </form>
      </div>

    </div>

  </section>

  <?php if ($username != getPlaceOwner($place)['username']) { ?>
    <script src="../js/preventDefaultEvent.js"></script>
    <script src="../js/checkDates.js"></script>
    <script src="../js/setTotalPrice.js"></script>
    <script src="../js/checkAvailableDates.js"></script>
  <?php } ?>
  <script src="../js/modal.js"></script>
<?php } ?>

<?php function draw_photo($photo)
                                                                                                                        {
                                                                                                                          /**
                                                                                                                           * Draws a single photo. Expects each photo to have
                                                                                                                           * a photo_id, url and place_id fields.
                                                                                                                           **/ ?>

  <div class="photo">
    <img src="<?php echo $photo['url']; ?>" id="modalImg" alt="Error">
  </div>

<?php } ?>

<?php function draw_reservation($reservation)
                                                                                                                        {
                                                                                                                          /**
                                                                                                                           * Draws a single reservation. Expects each reservation to have
                                                                                                                           * a reservation_id, guest_id, checkIn, checkOut and place_id.
                                                                                                                           */ ?>

  <div class="reservation">
    <h4 id="guest"> <?= getUsername($reservation['guest_id']) ?> </h4>
    <h4 id="dates"> <?= $reservation['checkIn'] ?> | <?= $reservation['checkOut'] ?> </h4>
  </div>
<?php } ?>