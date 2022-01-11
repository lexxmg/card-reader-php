
'use strict';

var placeholder = document.querySelector('.placeholder');


function startPlaceholder(event) {
  //console.log(event.target.href);
  placeholder.style.display = 'block';

  setTimeout(function() {
    document.location.href = event.target.href;
  } ,500);
}
