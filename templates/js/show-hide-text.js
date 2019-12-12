let showText = document.querySelector('.show-all-text');
let discriptionText = document.querySelector('.discription-text');
let previousHeight = discriptionText.clientHeight;

if ($('.discription-text').text().length<=800){
  $('.show-all-text').css("display","none");
  discriptionText.classList.toggle('gradient');
};

showText.addEventListener('click', show);

function show() {
  discriptionText.style.height = `${discriptionText.scrollHeight}px`;
  discriptionText.classList.toggle('gradient');
  showText.innerHTML = 'Свернуть';
  if (!discriptionText.classList.contains('gradient')) {
    showText.innerHTML = 'Развернуть';
    discriptionText.style.height = `${previousHeight}px`;
  };
};
