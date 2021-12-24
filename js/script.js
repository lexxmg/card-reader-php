
'use strict';

var placeholder = document.querySelector('.placeholder');


function startPlaceholder() {
  placeholder.style.display = 'block';

  setTimeout(function() {
    document.location.href = '/?photo=yes';
  } ,500);
}
