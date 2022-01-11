
'use strict';

<<<<<<< HEAD
var btn = document.querySelector('.card__link');
var placeholder = document.querySelector('.placeholder');

btn.addEventListener('click', function(event) {
  event.preventDefault();

  //placeholder.classList.remove('hidden');
  removeClass(placeholder, 'hidden');

  setTimeout(function() {
    document.location.href = '/?photo=yes';
  } ,1000);
});


function hasClass(ele,cls) {
  return !!ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
}

function addClass(ele,cls) {
  if (!hasClass(ele,cls)) ele.className += " "+cls;
}

function removeClass(ele,cls) {
  if (hasClass(ele,cls)) {
    var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
    ele.className=ele.className.replace(reg,' ');
  }
=======
var placeholder = document.querySelector('.placeholder');


function startPlaceholder() {
  placeholder.style.display = 'block';

  setTimeout(function() {
    document.location.href = '/?photo=yes';
  } ,500);
>>>>>>> 02b4ebbaee6f419b72efc1950d08f74a765498d7
}
