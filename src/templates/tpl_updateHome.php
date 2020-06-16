<?php function draw_updateHomeForm($place_id, $title, $pricePerDay, $location, $description, $photos)
{
    /*draws update a home form*/
?>

    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/hostHome.css" rel="stylesheet">
        <link href="../css/font.css" rel="stylesheet">
        <link href="../css/topNav.css" rel="stylesheet">
    </head>

    <body>
        <form id="hostHomeForm" enctype="multipart/form-data" action="../actions/action_updateHome.php" method="post">

            <input type="hidden" id="csrf" name="csrf" value="<?=$_SESSION['csrf']?>">           

            <h1>Update your Home</h1>

            <input id="place_id" type='hidden' name='place_id' value="<?= $place_id ?>" />

            <!-- One "tab" for each step in the form: -->
            <div class="tab">
                <h3>Title:</h3>
                <input type="text" value="<?= $title ?>" name="title" placeholder="A cool name for your place" pattern="[a-zA-Z\s.\-']+" oninput="this.className = ''">
            </div>

            <div class="tab">
                <h3>Price:</h3>
                <input type="number" value="<?= $pricePerDay ?>" name="pricePerDay" min="0" max="999" placeholder="Euro (Max 999€)" oninput="this.className = ''">
            </div>

            <div class="tab">
                <h3>Location:</h3>
                <input type="text" value="<?= $location ?>" name="location" placeholder="Your place address" pattern="[a-zA-Z\s.\-']+" oninput="this.className = ''">
            </div>

            <div class="tab">
                <h3>Description:</h3>
                <textarea name="description" placeholder="Description of your place ..." oninput="this.className = ''"><?= $description ?></textarea>
            </div>

            <div class="tab" id="photosUploaded">
                <h3>Photos:</h3>
                <?php $count = 0;
                foreach ($photos as $photo) { ?>
                    <div id="img">
                        <input type="text" value="<?= $photo['url'] ?>" name="imagesSrc[]" id="img<?= $count ?>" accept="image/*" oninput="this.className = ''" />
                        <img src="<?= $photo['url'] ?>" onclick="deleteImage(this);" alt="Error" width="120" height="80" onmouseover="this.src='../images/remove.jpeg';" onmouseout="this.src='<?= $photo['url'] ?>';">
                    </div>
                <?php $count = $count + 1;
                } ?>
                <div id="file">
                    <input type="file" onchange="displayImage(this); createNewDivFile(this);" name="photos[]" id="file0" accept="image/*" oninput="this.className = ''" />
                    <label id="imgPreview" for="file0"></label>
                </div>
            </div>

            <ul class="button">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </ul>

            <!-- Circles which indicates the steps of the form: -->
            <div class="stepButtons">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>

        </form>

        <script src="../js/hostHomeForm.js"></script>
        <script src="../js/deleteImages.js"></script>
    </body>

    </html>

<?php } ?>