let toggleBlock = document.querySelector('.toggle-block');
let toggleStickersLength = document.querySelectorAll('.toggle-sticker-itme');
let toggleStickersList = document.querySelector('.toggle-stickers-list');
let rightStickers = document.querySelector('.right-stickers');
let leftStickers = document.querySelector('.left-stickers');
let stickerPositon = 0;

if (toggleStickersLength.length > 5) toggleBlock.classList.add('big-stickers-list');

toggleStickersList.style.gridTemplateColumns = `repeat(${toggleStickersLength.length}, 1fr)`;

rightStickers.onclick = () => {
  if (stickerPositon >= (toggleStickersList.scrollWidth - toggleStickersList.clientWidth - toggleStickersLength[0].clientWidth)) return;
  stickerPositon += (toggleStickersLength[0].clientWidth + 10);
  toggleStickerPosition();
};

leftStickers.onclick = () => {
  if (stickerPositon <= 0) return
  stickerPositon -= (toggleStickersLength[0].clientWidth + 10);
  toggleStickerPosition();
};

function toggleStickerPosition() {
  toggleStickersList.style.transform = `translateX(-${stickerPositon}px)`;
};
