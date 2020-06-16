<?php function draw_searchForm()
{
    /*Draws search form section*/
    ?>

    <head>
        <link href="../css/form.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../ajax/locations.js" defer></script>
    </head>


    <form id="searchForm" autocomplete="off" method="get" action="../actions/action_searchForm.php">
        <p id="formTitle">Book unique places to stay and things to do
            <p />
            <label>Where </label>
            <div class="autocomplete">
                <input type="text" id="place" name="location" placeholder="Enter a destination name" pattern="[a-zA-ZÀ-ú\s.\-',]+" autofocus>
                <div id="suggestions" class="autocomplete-items"></div>
            </div>
            <label>Check-In</label>
            <input id="checkIn" type="date" name="checkIn" required="required" onchange="updateMinMax(0)">
            <label>Check-Out</label>
            <input id="checkOut" type="date" name="checkOut" required="required" onchange="updateMinMax(1)">
            <label>Maximum Price</label>
            <input type="range" name="maxPrice" min="0" max="999" value="50" class="slider" id="myRange">
            <p><span id="value"></span> € / Night</p>
            <input id="button" type="submit" value="Search">
    </form>

    <script src="../js/range_slider.js"></script>
    <script src="../js/checkDates.js"></script>
<?php } ?>