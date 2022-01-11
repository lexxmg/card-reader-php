
'use strict';

var placeholder = document.querySelector('.placeholder');


function startPlaceholder(event) {
  var ev = event || window.event; // get window.event if argument is falsy (in IE)
  console.log(window.event.attributes);
  placeholder.style.display = 'block';

  setTimeout(function() {
    document.location.href = ev.target.attributes.href.nodeValue;
  } ,500);
}
