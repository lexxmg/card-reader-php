
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

const psm = [  //Page segmentation modes:
  {value: 0, text: 'Orientation and script detection (OSD) only.'},
  {value: 1, text: 'Automatic page segmentation with OSD.'},
  {value: 2, text: 'Automatic page segmentation, but no OSD, or OCR. (not implemented)'},
  {value: 3, text: 'Fully automatic page segmentation, but no OSD. (Default)'},
  {value: 4, text: 'Assume a single column of text of variable sizes.'},
  {value: 5, text: 'Assume a single uniform block of vertically aligned text.'},
  {value: 6, text: 'Assume a single uniform block of text.'},
  {value: 7, text: 'Treat the image as a single text line.'},
  {value: 8, text: 'Treat the image as a single word.'},
  {value: 9, text: 'Treat the image as a single word in a circle.'},
  {value: 10, text: 'Treat the image as a single character.'},
  {value: 11, text: 'Sparse text. Find as much text as possible in no particular order.'},
  {value: 12, text: 'Sparse text with OSD.'},
  {value: 13, text: 'Raw line. Treat the image as a single text line, bypassing hacks that are Tesseract-specific.'}
];

function getPosition(event) {
    const cursorX = x - event.pageX;
    const cursorY = y - event.pageY;

    img.style.marginLeft = (-cursorX + marginLeft) + 'px';
    img.style.marginTop = (-cursorY + marginTop) + 'px';
}
