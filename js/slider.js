// Elements
let slides = document.querySelectorAll(".slide");
let backgroundSlider = document.querySelector('.background-slider')
let swrap	= document.querySelector(".slide-wrapper");
let thumbs = document.querySelector(".thumbs");
let thumb;
let narr = document.querySelector(".s-next");
let parr = document.querySelector(".s-prev");
let swidth = slides[0].offsetWidth;
let slength = slides.length;
let isSwitching = true;
let prevpos = 0;
let pos = 0;

for (let i = 0; i < slides.length; i++) {
  let dots = document.createElement('div');
  dots.classList.add('thumb');
  thumbs.appendChild(dots);
  thumb = document.querySelectorAll('.thumb');
  thumb[0].classList.add('active');
};

// setInterval(function () {
//   nextSlide();
// }, 4000);

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
	thumb[prevpos].classList.remove("active");
	thumb[pos].classList.add("active");
  backgroundSlider.style.transform = "translateX(-" + (pos * swidth) / 3 + "px)";
	swrap.style.transform = "translateX(-" + pos * swidth + "px)";
  setTimeout(function () {
    isSwitching = true;
  }, 2000);
};

function showByPos(index) {
	prevpos = pos;
	pos = index;
	showSlide();
};

// init controls
narr.onclick = nextSlide;
parr.onclick = prevSlide;
thumb.forEach(function(thumb, index) {
	thumb.onclick = function() {
		showByPos(index);
	};
});
