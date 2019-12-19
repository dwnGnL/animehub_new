let showText = document.querySelector('.show-all-text');
let discriptionText = document.querySelector('.discription-text');
let previousHeight = discriptionText.clientHeight;

if (discriptionText.scrollHeight > 160) discriptionText.classList.add('big-description');
if (discriptionText.scrollHeight <= 160) showText.remove();

showText.onclick = () => {
  discriptionText.style.height = `${discriptionText.scrollHeight}px`;
  discriptionText.classList.toggle('gradient');
  showText.innerHTML = 'Свернуть';
  if (!discriptionText.classList.contains('gradient')) {
    showText.innerHTML = 'Развернуть';
    discriptionText.style.height = `${previousHeight}px`;
  };
};
