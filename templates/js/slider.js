let sliderWidth, startContactSlider, endContactSlider;
let slider = document.querySelector('#slider');
let slides = document.querySelectorAll(".slide");
let backgroundSlider = document.querySelector('.background-slider');
let swrap	= document.querySelector(".slide-wrapper");
let narr = document.querySelector(".s-next");
let parr = document.querySelector(".s-prev");
let isSwitching = true;
let prevpos = 0;
let pos = 0;

res();
window.onresize = () => {
  res();
  resizeingShortingText();
};

function res() {
  sliderWidth = document.querySelector('#wrapper').clientWidth;
};

setInterval(nextSlide, 4000);

slider.addEventListener('touchstart', event => startContactSlider = event.targetTouches[0].pageX);
slider.addEventListener('touchmove', event => endContactSlider = event.targetTouches[0].pageX);

slider.addEventListener('touchstart', () => {
  setTimeout(() => {
    if (startContactSlider > (endContactSlider + 50)) nextSlide();
    if ((startContactSlider + 50) < endContactSlider) prevSlide();
  }, 300);
});

narr.addEventListener('click', nextSlide);
parr.addEventListener('click', prevSlide);

function nextSlide() {
  if (isSwitching) {
    isSwitching = false;
    prevpos = pos;
    pos < slides.length - 1 ? pos++ : pos = 0;
    showSlide();
  };
};

function prevSlide() {
  if (isSwitching) {
    isSwitching = false;
    prevpos = pos;
    pos > 0 ? pos-- : pos = slides.length - 1;
    showSlide();
  };
};

function showSlide() {
  backgroundSlider.style.transform = "translateX(-" + (pos * sliderWidth) / 3 + "px)";
  swrap.style.transform = "translateX(-" + pos * sliderWidth + "px)";
  setTimeout(() => {
    isSwitching = true;
  }, 2000);
};
