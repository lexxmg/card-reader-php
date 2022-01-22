
'use strict';

const photoContainer = document.querySelector('.settings-photo-img-container-js'),
      img = document.querySelector('.settings-photo-img-container__img');

let marginLeft = -1065;
let marginTop = -63;
let x;
let y;

img.style.marginLeft = marginLeft + 'px';
img.style.marginTop = marginTop + 'px';

photoContainer.addEventListener('mousedown', event => {
  event.preventDefault();

  x = event.pageX;
  y = event.pageY;

  photoContainer.addEventListener('mousemove', getPosition);
});

photoContainer.addEventListener('mouseup', event => {
  event.preventDefault();

  marginLeft = +img.style.marginLeft.split('px')[0];
  marginTop = +img.style.marginTop.split('px')[0];

  photoContainer.removeEventListener('mousemove', getPosition);
});

function getPosition(event) {
    const cursorX = x - event.pageX;
    const cursorY = y - event.pageY;

    img.style.marginLeft = (-cursorX + marginLeft) + 'px';
    img.style.marginTop = (-cursorY + marginTop) + 'px';
}
