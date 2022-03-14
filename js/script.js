
'use strict';

var placeholder = document.getElementById('ph');

function startPlaceholder(event) {
  var href = null;

  if (event.target) {
    href = event.target.attributes.href.nodeValue;
  } else {
    href = window.event.srcElement.attributes.href.nodeValue; // get window.event if argument is falsy (in IE)
  }
  //console.log(href);

  placeholder.style.display = 'block';

  setTimeout(function() {
    document.location.href = href;
  } ,500);
}

function powerOff(event) {
  var href = null;
  var xhr = new XMLHttpRequest();

  if (event.target) {
    href = event.target.attributes.href.nodeValue;
  } else {
    href = window.event.srcElement.attributes.href.nodeValue; // get window.event if argument is falsy (in IE)
  }

  xhr.open('GET', href);
  xhr.onreadystatechange = function() {
    if (xhr.readyState != 4 || xhr.status != 200) {
      return;
    }
    var response = xhr.response;
    //console.log(response);
  }
  xhr.send();

  // setTimeout(() => {
  //   document.location.href = '/';
  // }, 1000);

  // setTimeout(() => {
  //   document.location.reload();
  // }, 10000);
}
