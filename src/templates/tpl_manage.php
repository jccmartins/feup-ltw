<?php function draw_userPlaces($places)
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

    <h2> My listings </h2>

    <?php if (isset($_SESSION['messages'])) { ?>
      <h4 id="messages">
        <?php foreach ($_SESSION['messages'] as $message) { ?>
          <div class="<?= $message['type'] ?>"><?= $message['content'] ?></div>
        <?php } ?>
      </h4>
    <?php unset($_SESSION['messages']); 
    } ?>

    <?php if (count($places) == 0) { ?>
        <?php } ?>

        <section id="places">

            <?php

                foreach ($places as $place) { ?>

                <a href=<?php echo "../pages/place.php?place_id=" . $place['place_id']; ?>>
                    <?php draw_place($place); ?>
                </a>

            <?php } ?>

            <a href="hostHome.php">
                <?php draw_addPlace(); ?>
            </a>

        </section>
    <?php } ?>


    <?php function draw_place($place)
    {
        /**
         * Draw a single place as an article (.place). Uses the
         * draw_item function to draw each item. Expects each
         * place to have a place_id, title, pricePerDay, location,
         * description, user_id and photos fields.
         */ ?>

        <div id="container">
            <div class="image">
                <img src="<?= $place['photos'][0]['url']; ?>" alt="Error showing image">
            </div>
            <div class="desc">
                <p id="title"> <?= $place['title'] ?> </p>
                <p id="location"> <?= $place['location'] ?> </p>
            </div>
            <!-- <input id="button" type="button" value="Info"> -->
        </div>

    <?php } ?>


    <?php function draw_addPlace()
    {
        /**
         * TO DO
         * Draw a single place as an article (.place). Uses the
         * draw_item function to draw each item. Expects each
         * place to have a place_id, title, pricePerDay, location,
         * description, user_id and photos fields.
         */ ?>

        <div id="container">
            <div class="image">
                <img src="../images/addPhoto.jpg" alt="Error showing image">
            </div>
            <div class="desc">
                <p id="listing">Add a new place</p>
            </div>
            <!-- <input id="button" type="button" value="Add a listing"> -->
        </div>

    <?php } ?>