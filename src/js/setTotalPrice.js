function setTotalPrice(pricePerDay) {
    var checkIn = document.getElementsByTagName("input")[id = "checkIn"];
    var checkOut = document.getElementsByTagName("input")[id = "checkOut"];
    if (checkIn.checkValidity() && checkOut.checkValidity()) {
        var checkInDate = new Date(checkIn.value);
        var checkOutDate = new Date(checkOut.value);
        var diffTime = Math.abs(checkOutDate - checkInDate);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        pricePerDay = parseInt(pricePerDay);
        var totalPrice = pricePerDay * diffDays;
        document.getElementsByTagName("p")[id = "totalPrice"].innerHTML = "Total: " + totalPrice + "€";
    }
    else {
        document.getElementsByTagName("p")[id = "totalPrice"].innerHTML = "";
    }
}