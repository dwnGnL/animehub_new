let toggleStickersBlock = document.querySelector('.fa-smile');
let stickersList = document.querySelector('.stickers-list');

let stickersBlock = document.querySelector('.stickers-block');
let toggleBlock = document.querySelector('.toggle-block');
let toggleStickersLength = document.querySelectorAll('.toggle-sticker-itme');
let toggleStickersList = document.querySelector('.toggle-stickers-list');
let rightStickers = document.querySelector('.right-stickers');
let leftStickers = document.querySelector('.left-stickers');
let stickerPositon = 0;

if (toggleStickersLength.length > 5) toggleBlock.classList.add('big-stickers-list');
toggleStickersList.style.gridTemplateColumns = `repeat(${toggleStickersLength.length}, 1fr)`;


// toggleStickersLength.forEach((elem, index) => {
//   elem.onclick = () => {
//   };
// });


defaultStickers();

function defaultStickers() {
  stickersList.innerHTML = '';
  for (var i = 0; i < 100; i++) {
    stickersList.innerHTML +=`<li class="sticker-item"><img src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/${i}.png"></li>`;
  };
};

function facebookStickers() {
  stickersList.innerHTML = '';
  for (var i = 0; i < 98; i++) {
    stickersList.innerHTML +=`<li class="sticker-item"><img src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/facebookChat/facebook (${i}).png"></li>`;
  };
};

function milkbottleStickers() {
  stickersList.innerHTML = '';
  for (var i = 0; i < 47; i++) {
    stickersList.innerHTML +=`<li class="sticker-item"><img src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/milkbottle/Milk Bottle--${i + 1}.gif"></li>`;
  };
};

function onionStickers() {
  stickersList.innerHTML = '';
  for (var i = 0; i < 112; i++) {
    stickersList.innerHTML +=`<li class="sticker-item"><img src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/onion/Onion--${i + 1}.gif"></li>`;
  };
};

function redChatStickers() {
  stickersList.innerHTML = '';
  for (var i = 0; i < 21; i++) {
    stickersList.innerHTML +=`<li class="sticker-item"><img src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/redChat/red (${i + 1}).gif"></li>`;
  };
};



toggleStickersBlock.onclick = () => {
  if (stickersBlock.classList.contains('opacity-stickers-block')) {
    stickersBlock.classList.remove('opacity-stickers-block');
    setTimeout(() => stickersBlock.classList.remove('opent-stickers-block'), 500);
  } else {
    stickersBlock.classList.add('opent-stickers-block');
    setTimeout(() => stickersBlock.classList.add('opacity-stickers-block'), 0);
  };
};


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
