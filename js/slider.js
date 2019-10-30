let imagesSliderBlock = document.getElementById('images-slider-block');
let slideItem = document.querySelectorAll('.slide-item');
let slideIMG = document.querySelectorAll('.slide-img');
let right = document.querySelector('.s-next');
let left = document.querySelector('.s-prev');
let movePosition = true;
let previousPos = 0;
let pos = 1;
let nextPos = 2;
let objData = [];

for (var i = 0; i < imagesSliderBlock.children.length; i++) {
  objData.push(imagesSliderBlock.children[i].src);
}

left.addEventListener('click', toLeft);
right.addEventListener('click', toRight);

slideIMG[0].src = objData[previousPos];
slideIMG[1].src = objData[pos];
slideIMG[2].src = objData[nextPos];

function toRight() {
  if (movePosition) {
    movePosition = false;

    previousPos = pos;
    pos = nextPos;
    nextPos++;

    if (nextPos >= objData.length) {
      nextPos = 0;
    };

    for (let i = 0; i < slideItem.length; i++) {
      slideItem[i].style.transform = 'translateX(-100%)';
    };

    returnPosition();
    setTimeout(function () {
      movePosition = true;
    }, 2100);
  };
};

function toLeft() {
  if (movePosition) {
    movePosition = false;

    nextPos = pos;
    pos = previousPos;
    previousPos--;

    if (previousPos == -1) {
      previousPos = objData.length - 1;
    };

    for (let i = 0; i < slideItem.length; i++) {
      slideItem[i].style.transform = 'translateX(100%)';
    };

    returnPosition();
    setTimeout(function () {
      movePosition = true;
    }, 2100);
  };
};

function returnPosition() {
  setTimeout(function () {
    for (let i = 0; i < slideItem.length; i++) {
      slideItem[i].style.transition = '0s';
      slideItem[i].style.transform = 'translateX(0%)';
      setTimeout(function () {
        slideItem[i].style.transition = '2s';
      }, 100);
    };

    slideIMG[0].src = objData[previousPos];
    slideIMG[1].src = objData[pos];
    slideIMG[2].src = objData[nextPos];
  }, 2000);
};
