var today = new Date();
var dd = today.getDate();
var tomorrowDay = today.getDate() + 1;
var mm = today.getMonth() + 1; // January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}
if (mm < 10) {
    mm = '0' + mm
}

today = yyyy + '-' + mm + '-' + dd;
tomorrow = yyyy + '-' + mm + '-' + tomorrowDay;

document.getElementsByTagName("input")[id = "checkIn"].setAttribute('min', today);
document.getElementsByTagName("input")[id = "checkOut"].setAttribute('min', tomorrow);

function updateMinMax(value) {
    if (value === 0) {
        var currCheckInMin = document.getElementsByTagName("input")[id = "checkIn"].getAttribute('min');
        var currCheckIn = document.getElementsByTagName("input")[id = "checkIn"].value;

        currCheckIn = new Date(currCheckIn);
        currCheckIn.setDate(currCheckIn.getDate() + 1);

        var year = currCheckIn.getUTCFullYear();
        var month = currCheckIn.getUTCMonth() + 1; //months from 1-12
        if (month < 10) {
            month = '0' + month;
        }
        var day = currCheckIn.getUTCDate();
        if (day < 10) {
            day = '0' + day;
        }

        var newdate = year + '-' + month + '-' + day;
        console.log('currcheckinmin');
        console.log(currCheckInMin);
        console.log('newDate pro checkout');
        console.log(newdate);

        currCheckInMin = new Date(currCheckInMin);
        checkIn_isLarger = date_larger_than(currCheckInMin, currCheckIn);
        if (checkIn_isLarger == false) {
            document.getElementsByTagName("input")[id = "checkOut"].setAttribute('min', newdate);
        } else if (checkIn_isLarger == null) {
            document.getElementsByTagName("input")[id = "checkOut"].setAttribute('min', tomorrow);
        }
    } else if (value === 1) {
        var currCheckOutMin =
            document.getElementsByTagName("input")[id = "checkOut"].getAttribute('min');
        var currCheckOut = document.getElementsByTagName("input")[id = "checkOut"].value;

        currCheckOut = new Date(currCheckOut);
        currCheckOut.setDate(currCheckOut.getDate() - 1);

        var year = currCheckOut.getUTCFullYear();
        var month = currCheckOut.getUTCMonth() + 1; //months from 1-12
        if (month < 10) {
            month = '0' + month;
        }
        var day = currCheckOut.getUTCDate();
        if (day < 10) {
            day = '0' + day;
        }

        var checkOut_isLarger = date_larger_than(currCheckOutMin, currCheckOut);
        if (checkOut_isLarger == false) {
            document.getElementsByTagName("input")[id = "checkIn"].setAttribute('max', currCheckOut);
        } else if (checkOut_isLarger == null) {
            document.getElementsByTagName("input")[id = "checkIn"].removeAttribute('max');
        }
    }
}

// returns true if D1 > D2
function date_larger_than(D1, D2) {
    if (Object.prototype.toString.call(D1) === "[object Date]") {
        // it is a date
        if (isNaN(D1.getTime())) {
            return null;
        }
    } else {
        return null;
    }

    if (Object.prototype.toString.call(D2) === "[object Date]") {
        // it is a date
        if (isNaN(D2.getTime())) {
            return null;
        }
    } else {
        return null;
    }

    return (D1 > D2);
}

/**
 * Clear element with id message innerHTML
 */
function clearMessage() {
    document.getElementById("message").innerHTML = "";
}

/**
 * Check if dates are both valid on submit
 */
function areDatesValid() {
    // var checkIn = document.getElementsByTagName("input")[id = "checkIn"].value;
    // var checkOut = document.getElementsByTagName("input")[id = "checkOut"].value;
    // checkIn = new Date(checkIn);
    // checkOut = new Date(checkOut);
    // console.log("checkIN");
    // console.log(checkIn);
    // console.log("checkout");
    // console.log(checkOut);

    // if (Object.prototype.toString.call(checkIn) === "[object Date]") {
    //   // it is a date
    //   if (isNaN(checkIn.getTime())) {
    //     document.getElementById("message").innerHTML = "Dates are not valid!";
    //     return false;
    //   }
    // } else {
    //   document.getElementById("message").innerHTML = "Dates are not valid!";
    //   return false;
    // }

    // if (Object.prototype.toString.call(checkOut) === "[object Date]") {
    //   // it is a date
    //   if (isNaN(checkOut.getTime())) {
    //     document.getElementById("message").innerHTML = "Dates are not valid!";
    //     return false;
    //   }
    // } else {
    //   document.getElementById("message").innerHTML = "Dates are not valid!";
    //   return false;
    // }

    var checkIn = document.getElementsByTagName("input")[id = "checkIn"];
    var checkOut = document.getElementsByTagName("input")[id = "checkOut"];

    console.log("checkIN");
    console.log(checkIn);
    console.log("checkout");
    console.log(checkOut);

    if (!checkIn.checkValidity() || !checkOut.checkValidity()) {
        document.getElementById("message").innerHTML = "Dates are not valid!";
        return false;
    }

    return true;
}