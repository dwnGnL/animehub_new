let chooseAvatarBlock = document.querySelector('.choose-avatar');

for (var i = 0; i < 100; i++) {
  chooseAvatarBlock.innerHTML += '<div class="choose-avatar-item"><img class="choose-avatar-img" src="images/avatar/' + (i + 1) + '.png"></div>';
};


let chooseAvatar = document.querySelector('.left-profile');
let changeAvatar = document.querySelector('.profile-page-user-avatar');
let chooseAvatarImg = document.querySelectorAll('.choose-avatar-img');
let choosedIMG = document.querySelector('.profile-page-user-avatar-img');

changeAvatar.addEventListener('click', openCooseAvatar);

chooseAvatarImg.forEach((elem) => {
  elem.onclick = () => {
    closeCooseAvatar();
    choosedIMG.src = elem.src;
  };
});

function openCooseAvatar() {
  chooseAvatar.classList.add('open-choose-avatar');
  setTimeout(function () {chooseAvatar.classList.add('opacity-choose-avatar')}, 0);
};

function closeCooseAvatar() {
  setTimeout(function () {chooseAvatar.classList.remove('open-choose-avatar')}, 500);
  chooseAvatar.classList.remove('opacity-choose-avatar');
};



let rightProfile = document.querySelector('.right-profile');
let accountButton = document.querySelector('.account-button');
let vipSettingButton = document.querySelector('.vip-setting-button');

accountButton.addEventListener('click', () => togglePage('show-account', 'show-vip-setting', 'account-opacity', 'vip-setting-opacity'));
vipSettingButton.addEventListener('click', () => togglePage('show-vip-setting', 'show-account', 'vip-setting-opacity', 'account-opacity'));

function togglePage(presentPage, previousPage, presentOpacity, previousOpacity) {
  rightProfile.classList.remove(previousOpacity);

  setTimeout(function () {
    rightProfile.classList.add(presentPage);
    rightProfile.classList.remove(previousPage);
    setTimeout(function () {rightProfile.classList.add(presentOpacity)}, 10);
  }, 300);
};

let changeProfileData = document.querySelectorAll('.change-profile-data');
let changeProfileDataSelect = document.querySelector('.change-profile-data-select');
let saveChangePlace = document.querySelector('.save-change-button-place');
let changeButton = document.querySelector('.change-button');
let saveChange = document.querySelector('.save-button');
let dataItem, dataSelectItem;
let givedDate = [];

changeButton.addEventListener('click', changeDate);
saveChange.addEventListener('click', saveDate);

function changeDate() {
  for (let i = 0; i < changeProfileData.length; i++) {
    changeProfileData[i].innerHTML = `<input class="profile-data-input" type="text" value="${changeProfileData[i].innerHTML}">`;
    dataItem = document.querySelectorAll('.profile-data-input')
  };

  changeProfileDataSelect.innerHTML = `
    <select>
    <option class="qwer">Мужской</option>
    <option class="qwer">Женский</option>
    </select>`

  qwer = document.querySelectorAll('.qwer');

  // for (var i = 0; i < qwer.length; i++) {
  //   dataSelectItem = qwer[i];
  // }

  console.log(dataSelectItem);

  // qwer.forEach((elem) => {
  //   elem.onclick = () => {
  //     alert(elem.innerHTML)
  //   }
  // })

  saveChangePlace.classList.remove('changed');
  saveChangePlace.classList.add('saved');
};

function saveDate() {
  for (let i = 0; i < changeProfileData.length; i++) {
    givedDate.push(dataItem[i].value);
    changeProfileData[i].innerHTML = givedDate[i];
  };

  saveChangePlace.classList.remove('saved');
  saveChangePlace.classList.add('changed');
};
