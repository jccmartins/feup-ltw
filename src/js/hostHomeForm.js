//PHOTOS
fileId = 0;

addEvtListener(document.getElementById("imgPreview"));

function addEvtListener(element) {
    element.addEventListener("click", function(event) {
        clickHandler(element, event);
    });
}

function clickHandler(element, event) {
    var divFile = element.parentElement;
    var input = divFile.getElementsByTagName("input")[0];
    console.log(input.value);
    if (input.value !== "") {
        event.preventDefault();
        deleteFile(element);
        console.log("NOT null");
    } else {
        console.log("null");
    }
}

function displayImage(element) {
    var reader = new FileReader();
    var imgPreview = element.parentElement.getElementsByTagName("label")[id = "imgPreview"];
    // imgPreview.setAttribute("style", "width:120px");
    // imgPreview.setAttribute("style", "height:80px");
    reader.onload = function() {
        imgPreview.onmouseover = function() {
            imgPreview.style.backgroundImage = 'url(../images/remove.jpeg)';
            imgPreview.style.backgroundSize = 'cover';
            imgPreview.style.backgroundRepeat = 'no-repeat';
            imgPreview.style.backgroundPosition = 'center center';
            imgPreview.style.cursor = 'pointer';
        };

        imgPreview.onmouseout = function() {
            imgPreview.style.backgroundImage = "url(" + reader.result + ")";
            imgPreview.style.backgroundSize = "cover";
            imgPreview.style.backgroundRepeat = "no-repeat";
            imgPreview.style.backgroundPosition = "center center";
        };

        // imgPreview.style.backgroundAttachment = "fixed";
        // imgPreview.style.backgroundPosition = "center";
        // imgPreview.style.backgroundSize = "cover";
    }
    reader.readAsDataURL(element.files[0]);
    console.log(document.getElementsByClassName("tab")[4]);
}

function createNewDivFile(element) {
    fileId = fileId + 1;
    var photosTab = document.getElementsByClassName("tab")[4];
    var divFile = element.parentNode;
    var clone = divFile.cloneNode(true);
    clone.getElementsByTagName("input")[0].setAttribute("id", "file" + fileId);
    clone.getElementsByTagName("input")[0].value = "";
    clone.getElementsByTagName("label")[0].setAttribute("for", "file" + fileId);
    //clone.getElementsByTagName("label")[0].style.backgroundImage = "url(\"../images/addPhoto.jpg\")";
    addEvtListener(clone.getElementsByTagName("label")[0]);
    photosTab.appendChild(clone);
}

function deleteFile(element) {
    var AllDivFile = document.getElementsByClassName("tab")[4].getElementsByTagName("div");
    if (AllDivFile.length > 1) {
        var divFile = element.parentNode;
        var photosTab = document.getElementsByClassName("tab")[4];
        photosTab.removeChild(divFile);
    } else {
        //element.style.backgroundImage = "url(" + "../images/addPhoto.jpg" + ")";
        var divFile = element.parentNode;
        divFile.getElementsByTagName("input")[0].value = "";
        // var newInput = document.createElement("input");
        // newInput.type = "file";
        // newInput.name = "photo";
        // newInput.onchange = displayImage(this);
        // newInput.id = "real-file";
        // newInput.accept = "image/*";
        // newInput.oninput = "this.className = ''";
        // element.parentNode.replaceChild(newInput, input);
        console.log(document.getElementsByClassName("tab")[4]);
    }
}

// function uploadPhotos() {
//     var photosNumbers = document.getElementsByTagName("input")[id = "photosNumbers"];
//     // var photosNumbersArray = new Array();
//     // for (var pair of formData.entries()) {
//     //     photosNumbersArray.push(pair[0]);
//     // }
//     // photosNumbers.value = photosNumbersArray;
//     photosNumbers.value = JSON.stringify(formData);
//     alert(photosNumbers.value);
// }


//HOST HOME FORM --------------------------------------------------------
var textRegex = /^[a-záàâãéèêíïóôõöúçñ0-9\s.\-'!\?,\/+]+$/im;
var descriptionRegex = /^[a-záàâãéèêíïóôõöúçñ0-9\s.\-'!\?,\/+]+$/im;

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab


function eventListener(n) {
    // Get the input field
    var x = document.getElementsByClassName("tab");
    var input = x[n];

    // Execute a function when the user releases ENTER
    input.addEventListener("keydown", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode == 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Stopping propagation to ancestor elements
            event.stopPropagation();
            // Stopping other handlers on the same element from being called
            event.stopImmediatePropagation();
            // Trigger the button element with a click
            var nextBtn = document.getElementById("nextBtn");
            nextBtn.click();
        }
    });
}

function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n);

    // Não fazer para description porque description é uma textarea e precisa
    // de usar ENTER para fazer paragrafo
    if (currentTab != x.length - 2) {
        eventListener(n);
    }
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (!validateForm(n)) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("hostHomeForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm(n) {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    z = x[currentTab].getElementsByTagName("textarea");
    var isFile = false;
    var isThereAFile = false;
    var isThereAImg = false;
    // A loop that checks every input field in the current tab:
    if (n == 1) {
        //check every input
        for (i = 0; i < y.length; i++) {
            //check if there is an input text with img src from database when user is updating his places
            if ((y[i].type == "text") && (y[i].getAttribute("id") != null)) {
                if (y[i].getAttribute("id").includes("img")) {
                    console.log("IMAGEM");
                    isThereAImg = true;
                }
            }
            //check if text is not empty
            else if (y[i].type == "text") {
                // If a field is empty...
                if (y[i].value == "" || !textRegex.test(y[i].value)) {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            //check if number is greater than or equal to 0 and lower or equal to 999
            else if (y[i].type == "number") {
                var number = parseInt(y[i].value);

                if (isNaN(number) || number < 0 || number > 999) {

                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            //check if files uploaded are more than 0
            else if (y[i].type == "file") {
                isFile = true;
                if (y[i].files.length == 1) {
                    isThereAFile = true;
                }
            }
        }
        if ((isThereAFile == false && isFile == true) && !isThereAImg) {
            var photosTab = document.getElementsByClassName("tab")[4];
            var firstInput = photosTab.getElementsByTagName("input")[0];
            // add an "invalid" class to the field:
            firstInput.className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }
        //check every textarea
        for (i = 0; i < z.length; i++) {
            // If a field is empty...
            // /g to replace all of the matching values
            var description = z[i].value.replace(/\s+/g, "");
            description = description.replace(/(\r\n|\n|\r)+/g, "");
            if (description === "" || !descriptionRegex.test(description)) {
                // add an "invalid" class to the field:
                z[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }
        }
    } else if (n == -1) {
        //check every input
        for (i = 0; i < y.length; i++) {
            // remove possible "invalid" class to the field
            y[i].className -= " invalid";

            //check if there is an input text with img src from database when user is updating his places
            if ((y[i].type == "text") && (y[i].getAttribute("id") != null)) {
                if (y[i].getAttribute("id").includes("img")) {
                    console.log("IMAGEM");
                    isThereAImg = true;
                }
            }
            //check if text is not empty
            else if (y[i].type == "text") {
                // If a field is empty...
                if (y[i].value == "" || !textRegex.test(y[i].value)) {
                    valid = false;
                }
            }
            //check if number is greater than or equal to 0
            else if (y[i].type == "number") {
                var number = parseInt(y[i].value);
                if (isNaN(number) || (!isNaN(number) && ((number < 0) || (number > 999)))) {
                    valid = false;
                }
            }
            //check if files uploaded are more than 0
            else if (y[i].type == "file") {
                isFile = true;
                if (y[i].files.length == 1) {
                    isThereAFile = true;
                }
            }
        }
        if ((isThereAFile == false && isFile == true) && !isThereAImg) {
            var photosTab = document.getElementsByClassName("tab")[4];
            var firstInput = photosTab.getElementsByTagName("input")[0];
            // // add an "invalid" class to the field:
            // firstInput.className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }
        //check every textarea
        for (i = 0; i < z.length; i++) {
            // If a field is empty...
            // /g to replace all of the matching values
            var description = z[i].value.replace(/\s+/g, "");
            description = description.replace(/(\r\n|\n|\r)+/g, "");
            if (description === "" || !descriptionRegex.test(description)) {
                valid = false;
            }
        }
    }

    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    } else {
        document.getElementsByClassName("step")[currentTab].className = "step";
    }

    //even if input is invalid, when n == -1 you can go to previous tab
    if (n == -1) {
        valid = true;
    }

    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
}

// const realFileBtn = document.getElementById("real-file");
// const customBtn = document.getElementById("custom-button");
// const customTxt = document.getElementById("custom-text");

// customBtn.addEventListener("click", function() {
//     realFileBtn.click();
// });

// realFileBtn.addEventListener("change", function() {
//     if (realFileBtn.value) {
//         customTxt.innerHTML = realFileBtn.value.match(
//             /[\/\\]([\w\d\s\.\-\(\)]+)$/
//         )[1];
//     } else {
//         customTxt.innerHTML = "No file chosen, yet.";
//     }
// });