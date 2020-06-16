function validateDates() {
    var place_id = document.getElementsByTagName("input")[id = "place_id"].value;
    var checkIn = document.getElementsByTagName("input")[id = "checkIn"].value;
    var checkOut = document.getElementsByTagName("input")[id = "checkOut"].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText === "") {
                document.getElementsByTagName("form")[id = "reservationForm"].submit();
            } else {
                document.getElementById("message").innerHTML = this.responseText;
            }
        }

        return false;
    };
    var params = "place_id=" + place_id + "&checkIn=" + checkIn + "&checkOut=" + checkOut;
    xhttp.open("POST", "../ajax/validateReservation.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);
}