
'use strict';

var placeholder = document.querySelector('.placeholder');


function startPlaceholder(event) {
  var href = null;

  if (event.target) {
    href = event.target.attributes.href.nodeValue;
  } else {
    href = window.event.srcElement.attributes.href.nodeValue; // get window.event if argument is falsy (in IE)
  }
  console.log(href);
  placeholder.style.display = 'block';

  setTimeout(function() {
    document.location.href = href;
  } ,500);
}
