<?php function draw_userReservations($reservations)
{
    /**
     * Draws a section (#places) containing several places
     * as articles. Uses the draw_place function to draw
     * each place.
     */ ?>

    <head>
        <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <link href="../css/places.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <h2> My reservations </h2>

    <?php if (isset($_SESSION['messages'])) { ?>
      <h4 id="messages">
        <?php foreach ($_SESSION['messages'] as $message) { ?>
          <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
        <?php } ?>
      </h4>
    <?php unset($_SESSION['messages']); 
    } ?>
    
    <?php if (count($reservations) == 0) { ?>
        <h3> You haven't made a reservation yet. <a href="home.php" style="text-decoration:none">Get Started</a></h2>
        <?php } ?>

        <section id="places">

            <?php

                foreach ($reservations as $reservation) { ?>

                <div id="container">
                    <?php draw_reservation($reservation); ?>
                </div>

            <?php } ?>

        </section>
    <?php } ?>


    <?php function draw_reservation($reservation)
    {
        /**
         * Draw a single place as an article (.place). Uses the
         * draw_item function to draw each item. Expects each
         * place to have a place_id, title, pricePerDay, location,
         * description, user_id and photos fields.
         */ ?>
        <a href=<?php echo "../pages/place.php?place_id=" . $reservation['place_id']; ?>>
            <div class="image">
                <img src="<?= $reservation['photos'][0]['url']; ?>" alt="Error showing image">
            </div>
            <div class="desc">
                <div id="checkInCheckOut">
                    <p id="checkIn">Check In</p>
                    <p id="checkOut">Check Out</p>
                </div>
                <div id="dates">
                    <p id="checkIn"> <?= $reservation['checkIn'] ?> </p>
                    <p id="checkOut"> <?= $reservation['checkOut'] ?> </p>
                </div>
            </div>
        </a>

        <form id="deleteReservation" action="../actions/action_removeReservation.php" method="post">
            <input type="hidden" id="reservation_id" name="reservation_id" value="<?= $reservation['reservation_id'] ?> ">
            <input type="hidden" id="csrf" name="csrf" value="<?=$_SESSION['csrf']?>">           
            <input id="button" type="submit" value="Cancel">
        </form>

    <?php } ?>