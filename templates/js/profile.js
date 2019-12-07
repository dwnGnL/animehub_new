// Choose avater
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
    choosedIMG.src = elem.src;
    closeCooseAvatar();
  };
});

window.addEventListener('click', () => {
  if (chooseAvatar.classList.contains('open-choose-avatar') && chooseAvatar.classList.contains('opacity-choose-avatar')) closeCooseAvatar();
})

function openCooseAvatar() {
  chooseAvatar.classList.add('open-choose-avatar');
  setTimeout(function () {chooseAvatar.classList.add('opacity-choose-avatar')}, 10);
};

function closeCooseAvatar() {
  setTimeout(function () {chooseAvatar.classList.remove('open-choose-avatar')}, 500);
  chooseAvatar.classList.remove('opacity-choose-avatar');
};

// Toggle profile page
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

// Change profile data
let changeProfileData = document.querySelectorAll('.change-profile-data');
let changeProfileDataSelect = document.querySelector('.change-profile-data-select');
let saveChangePlace = document.querySelector('.save-change-button-place');
let changeButton = document.querySelector('.change-button');
let saveChange = document.querySelector('.save-button');
let dataItem, dataSelectItem, select;
let givedDate = [];

changeButton.addEventListener('click', changeDate);
saveChange.addEventListener('click', saveDate);

function changeDate() {
  for (let i = 0; i < changeProfileData.length; i++) {
    changeProfileData[i].innerHTML = `<input class="profile-data-input" type="text" value="${changeProfileData[i].innerHTML}">`;
    dataItem = document.querySelectorAll('.profile-data-input');
  };

  changeProfileDataSelect.innerHTML = `
    <select class="select">
      <option>Мужской</option>
      <option>Женский</option>
    </select>`;

  select = document.querySelector('.select');

  saveChangePlace.classList.remove('changed');
  saveChangePlace.classList.add('saved');
};

function saveDate() {
  for (let i = 0; i < changeProfileData.length; i++) {
    givedDate.push(dataItem[i].value);
    changeProfileData[i].innerHTML = givedDate[i];
  };

  changeProfileDataSelect.innerHTML = select.value;

  saveChangePlace.classList.remove('saved');
  saveChangePlace.classList.add('changed');
};


// Change font family
let fontFamilyUserName = document.querySelector('.font-family-user-name');
let fontFamilyType = document.querySelector('.font-family-type');
let saveVip = document.querySelector('.save-vip-button');

saveVip.addEventListener('click', saveingVip);

function saveingVip() {
  fontFamilyUserName.style.fontFamily = fontFamilyType.value;
}


$('#colorSelector').ColorPicker({
	color: '#0000ff',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
    $('#colorSelector div').css('backgroundColor', '#' + hex);
    $('.left-profile-user-name.font-family-user-name').css('color', '#' + hex);

	}
});

$("#save_profile").click(function () { 
  $.ajax({
    type: "post",
    url: "/ajax/save/profile",
    data: ({"token":$("#token").text(),"age":text,"id_post":id_post}),
    dataType: "text",
    success: function (response) {

        res= JSON.parse(response);
        if (res.status == 403){
            alert('Авторизуйтесь пожалуйста');
            $('.form .disable').css('display','none')
            return false;
        }
            
    }
});
  
});

$("#save_vip").click(function () { 
  $.ajax({
    type: "post",
    url: "/ajax/save/profile",
    data: ({"token":$("#token").text(),"age":text,"id_post":id_post}),
    dataType: "text",
    success: function (response) {

        res= JSON.parse(response);
        if (res.status == 403){
            alert('Авторизуйтесь пожалуйста');
            $('.form .disable').css('display','none')
            return false;
        }
            
    }
});
  
});