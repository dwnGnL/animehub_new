let toggleStickersBlock = document.querySelector('.fa-smile');
let stickersList = document.querySelectorAll('.stickers-list');
let stickersBlock = document.querySelector('.stickers-block');
let toggleBlock = document.querySelector('.toggle-block');
let toggleStickersLength = document.querySelectorAll('.toggle-sticker-itme');
let toggleStickersList = document.querySelector('.toggle-stickers-list');
let rightStickers = document.querySelector('.right-stickers');
let leftStickers = document.querySelector('.left-stickers');
let stickerPositon, prevStickersList, presStickersList = 0;


if (toggleStickersLength.length > 5) toggleBlock.classList.add('big-stickers-list');
toggleStickersList.style.gridTemplateColumns = `repeat(${toggleStickersLength.length}, 1fr)`;



stickersList[0].classList.add('choosed-stickers-liset');

toggleStickersLength.forEach((elem, index) => {
  elem.onclick = () => {
    prevStickersList = presStickersList;
    presStickersList = index;
    stickersList[prevStickersList].classList.remove('choosed-stickers-liset');
    stickersList[presStickersList].classList.add('choosed-stickers-liset');
  };
});

for (var i = 0; i < 100; i++) {
  stickersList[0].innerHTML +=`<li class="sticker-item"><img class="sticker-item-smile" src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/${i}.png"></li>`;
};
for (var i = 0; i < 98; i++) {
  stickersList[1].innerHTML +=`<li class="sticker-item"><img class="sticker-item-smile" src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/facebookChat/facebook (${i}).png"></li>`;
};
for (var i = 0; i < 47; i++) {
  stickersList[2].innerHTML +=`<li class="sticker-item"><img class="sticker-item-sticker" src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/milkbottle/Milk Bottle--${i + 1}.gif"></li>`;
};
for (var i = 0; i < 112; i++) {
  stickersList[3].innerHTML +=`<li class="sticker-item"><img class="sticker-item-sticker" src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/onion/Onion--${i + 1}.gif"></li>`;
};
for (var i = 0; i < 21; i++) {
  stickersList[4].innerHTML +=`<li class="sticker-item"><img class="sticker-item-sticker" src="/templates/Admin/js/ckeditor/plugins/hkemoji/sticker/redChat/red (${i + 1}).gif"></li>`;
};


let stickerItemSmile = document.querySelectorAll('.sticker-item-smile');
let stickerItemSticker = document.querySelectorAll('.sticker-item-sticker');

stickersBlock.onclick = (e)=>{
  e.stopPropagation();

}
stickerItemSmile.forEach((elem, index) => {
  elem.onclick = (e) => {

    var mymessage =`<img src="${elem.src}">`;
    CKEDITOR.instances['redactor'].insertHtml(mymessage);
  };
});

stickerItemSticker.forEach((elem, index) => {
  elem.onclick = () => {
    var user = JSON.parse(localStorage.getItem('user'));

    var msg = {
        message: `<img src="${elem.src}">`,
        id_user: user.id,
        login: user.login,
        login_color: user.login_color,
        font: user.font
    };

    sendMessage(msg.message);
    stickersBlock.classList.remove('opacity-stickers-block');
    setTimeout(() => stickersBlock.classList.remove('opent-stickers-block'), 500);
  };
});


document.body.onclick=()=>{
  stickersBlock.classList.remove('opacity-stickers-block');
  setTimeout(() => stickersBlock.classList.remove('opent-stickers-block'), 500);
}



toggleStickersBlock.onclick = (e) => {
  e.stopPropagation();
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
