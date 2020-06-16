<?php function draw_places($places, $location)
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

  <?php if (count($places) == 0) { ?>
    <h2> No results found </h2>
  <?php } else { ?>
    <?php if ($location == '') { ?>
      <h2> All results </h2>
    <?php } else { ?>
      <h2> Results for <?= $location ?></h2>
    <?php } ?>
    <section id="places">

      <?php

          foreach ($places as $place) { ?>

        <a href=<?php echo "../pages/place.php?place_id=" . $place['place_id']; ?>>
          <?php draw_place($place); ?>
        </a>

      <?php } ?>

    </section>
  <?php } ?>

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
      <p id="pricePerDay"> <strong><?= $place['pricePerDay'] ?>€</strong> / night</p>
    </div>
  </div>

<?php } ?>