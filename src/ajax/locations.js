let text = document.getElementById('place');
text.addEventListener('keyup', placeChanged);
text.addEventListener('keydown', clear);

// Handler for change event on text input
function placeChanged(event) {
  var key = event.key || event.keyCode;
  if (key === 'Escape') {
    clearList();
  } else {
    let text = event.target;
    let request = new XMLHttpRequest();
    request.addEventListener('load', placesReceived);
    request.open(
        'get', '../ajax/db_getLocations.php?location=' + text.value, true);
    request.send();
  }
}

function clear(event) {
  var key = event.key || event.keyCode;

  if (key === 'Enter' || key === 'Tab') {
    clearList()
  }
}

// Handler for ajax response received
function placesReceived() {
  if (!emptyString(text.value)) {
    let places = JSON.parse(this.responseText);

    let list = document.getElementById('suggestions');
    list.innerHTML = '';  // Clean current place

    // Add new suggestions
    for (place in places) {
      // let item = document.createElement('div');
      // item.innerHTML = places[place].location;

      /*create a DIV element for each matching element:*/
      b = document.createElement('DIV');
      /*make the matching letters bold:*/
      b.innerHTML += places[place].location;
      /*insert a input field that will hold the current array item's value:*/
      b.innerHTML += '<input type=\'hidden\' class=\'suggestion\' value=\'' +
          places[place].location + '\'>';
      /*execute a function when someone clicks on the item value (DIV
       * element):*/
      b.addEventListener('click', function(e) {
        /*insert the value for the autocomplete text field:*/
        text.value = this.getElementsByClassName('suggestion')[0].value;
        list.innerHTML = '';
      });

      list.appendChild(b);
    }
  } else {
    clearList()
  }
}
// Clears suggestions list
function clearList() {
  let list = document.getElementById('suggestions');
  list.innerHTML = '';  // Clean current place
}

function emptyString(str) {
  if (str == '')
    return true;

  var i = str.length;
  while (i--) {
    if (str[i] != ' ')
      return false;
  }

  return true;
}
