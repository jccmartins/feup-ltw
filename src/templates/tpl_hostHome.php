<?php function draw_hostHomeForm()
{
    /*draws host a home form*/
    ?>

    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>Host a Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/hostHome.css" rel="stylesheet">
        <link href="../css/font.css" rel="stylesheet">
        <link href="../css/topNav.css" rel="stylesheet">
    </head>

    <body>
        <form id="hostHomeForm" enctype="multipart/form-data" action="../actions/action_addHome.php" method="post">

            <h1>Host a Home</h1>

            <!-- One "tab" for each step in the form: -->
            <div class="tab">
                <h3>Title:</h3>
                <input type="text" name="title" placeholder="A cool name for your place" oninput="this.className = ''">
            </div>

            <div class="tab">
                <h3>Price:</h3>
                <input type="number" name="pricePerDay" min="0" max="999" placeholder="Euro (Max 999€)" oninput="this.className = ''">
            </div>

            <div class="tab">
                <h3>Location:</h3>
                <input type="text" name="location" placeholder="Your place address" oninput="this.className = ''">
            </div>

            <div class="tab">
                <h3>Description:</h3>
                <textarea name="description" placeholder="Description of your place ..." oninput="this.className = ''"></textarea>
            </div>

            <div class="tab" id="photosUploaded">
                <h3>Photos:</h3>
                <!-- <input type="file" id="file" name="photos[]" multiple accept="image/*" oninput="this.className = ''" class="inputfile">
                <label for="file">Choose files to upload</label> -->
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
    </body>

    </html>

<?php } ?>