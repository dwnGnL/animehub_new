let showText = document.querySelector('.show-all-text');
let discriptionText = document.querySelector('.discription-text');
let previousHeight = discriptionText.clientHeight;

showText.addEventListener('click', show);

function show() {
  discriptionText.style.height = `${discriptionText.scrollHeight}px`;
  discriptionText.classList.toggle('gradient');
  if (!discriptionText.classList.contains('gradient')) discriptionText.style.height = `${previousHeight}px`;
}
