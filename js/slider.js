let slides = document.querySelectorAll(".slide");
let backgroundSlider = document.querySelector('.background-slider')
let swrap	= document.querySelector(".slide-wrapper");
let narr = document.querySelector(".s-next");
let parr = document.querySelector(".s-prev");
let swidth = slides[0].offsetWidth;
let slength = slides.length;
let isSwitching = true;
let prevpos = 0;
let pos = 0;

narr.addEventListener('click', nextSlide)
parr.addEventListener('click', prevSlide)

function nextSlide() {
  if (isSwitching) {
    isSwitching = false
    prevpos = pos;
    pos < slength - 1 ? pos++ : pos = 0;
    showSlide();
  };
};

function prevSlide() {
  if (isSwitching) {
    isSwitching = false
    prevpos = pos;
    pos > 0 ? pos-- : pos = slength - 1;
    showSlide();
  };
};

function showSlide() {
  backgroundSlider.style.transform = "translateX(-" + (pos * swidth) / 3 + "px)";
	swrap.style.transform = "translateX(-" + pos * swidth + "px)";
  setTimeout(function () {
    isSwitching = true;
  }, 2000);
};

setInterval(nextSlide,2000)