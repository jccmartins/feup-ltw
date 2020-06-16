var handler = function (event) {
    // Number 27 is the "ESC" key on the keyboard
    if (event.keyCode == 27) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Stopping propagation to ancestor elements
        event.stopPropagation();
        // Stopping other handlers on the same element from being called
        event.stopImmediatePropagation();
        // Close modal
        closeModal();
    }

    // Number 37 is the "Arrow Left" key on the keyboard
    if (event.keyCode == 37) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Stopping propagation to ancestor elements
        event.stopPropagation();
        // Stopping other handlers on the same element from being called
        event.stopImmediatePropagation();
        // displays image before
        plusSlides(-1);
    }

    // Number 39 is the "Arrow Right" key on the keyboard
    if (event.keyCode == 39) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Stopping propagation to ancestor elements
        event.stopPropagation();
        // Stopping other handlers on the same element from being called
        event.stopImmediatePropagation();
        // displays next image
        plusSlides(1);
    }
}

function eventListener() {
    // Execute a function when the user releases ENTER
    document.addEventListener("keydown", handler);
}

function removeEventListener() {
    document.removeEventListener("keydown", handler);
}

// Open the Modal
function openModal() {
    document.getElementById("myModal").style.display = "block";
    eventListener();
    // showSlides(slideIndex);
}

// Close the Modal
function closeModal() {
    // slideIndex = 1;
    removeEventListener();
    document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    //   var dots = document.getElementsByClassName("demo");
    //   var captionText = document.getElementById("caption");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    //   for (i = 0; i < dots.length; i++) {
    //     dots[i].className = dots[i].className.replace(" active", "");
    //   }
    slides[slideIndex - 1].style.display = "block";
    //   dots[slideIndex-1].className += " active";
    //   captionText.innerHTML = dots[slideIndex-1].alt;
}