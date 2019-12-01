let adviceSliderItem	= document.querySelector(".advice-slider-item");
let adviceItem = document.querySelectorAll('.advice-item');
let adviceItemWidth = adviceItem[0].clientWidth;
let dotsBlock = document.querySelector('.dots')
let dotAdviceSlider;
let prevposAdvice = 0;
let posAdvice = 0;

for (let i = 0; i < adviceItem.length; i++) {
  let dotItem = document.createElement('div');
  dotItem.classList.add('dot-item');
  dotsBlock.appendChild(dotItem);
  dotAdviceSlider = document.querySelectorAll('.dot-item');
  dotAdviceSlider[0].classList.add('active-dot-item');
};

setInterval(() => {
  prevposAdvice = posAdvice;
  posAdvice >= adviceItem.length - 1 ? posAdvice = 0 : posAdvice++;
  showAdviceSlider();
}, 5000);

dotAdviceSlider.forEach(function(elem, index) {
  elem.onclick = function() {
    prevposAdvice = posAdvice;
    posAdvice = index;

    showAdviceSlider();
  };
});

function showAdviceSlider() {
	adviceSliderItem.style.transform = "translateX(-" + posAdvice * adviceItemWidth + "px)";
  dotAdviceSlider[prevposAdvice].classList.remove('active-dot-item');
  dotAdviceSlider[posAdvice].classList.add('active-dot-item');
};
