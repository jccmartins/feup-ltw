function deleteImage(element) {
    var divImg = element.parentNode;
    var photosTab = document.getElementsByClassName("tab")[4];
    photosTab.removeChild(divImg);
}