// Choose avater
let chooseAvatarBlock = document.querySelector('.choose-avatar');

for (var i = 0; i < 100; i++) {
  chooseAvatarBlock.innerHTML += '<div class="choose-avatar-item"><img class="choose-avatar-img" src="'+location.origin+'/templates/images/avatar/' + (i + 1) + '.png"></div>';
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
  setTimeout(() => {chooseAvatar.classList.add('opacity-choose-avatar')}, 10);
};

function closeCooseAvatar() {
  setTimeout(() => {chooseAvatar.classList.remove('open-choose-avatar')}, 500);
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

  setTimeout(() => {
    rightProfile.classList.add(presentPage);
    rightProfile.classList.remove(previousPage);
    setTimeout(() => {rightProfile.classList.add(presentOpacity)}, 10);
  }, 300);
};

// Change profile data
let changeProfileData = document.querySelectorAll('.change-profile-data');
let changeProfileDataSelect = document.querySelector('.change-profile-data-select');
let saveChangePlace = document.querySelector('.save-change-button-place');
let changeButton = document.querySelector('.change-button');
// let saveChange = document.querySelector('.save-button');
let dataItem, dataSelectItem, select;
let givedDate = [];

changeButton.addEventListener('click', changeDate);
// saveChange.addEventListener('click', saveDate);

function changeDate() {
  for (let i = 0; i < changeProfileData.length; i++) {
    changeProfileData[i].innerHTML = `<input class="profile-data-input" type="text" value="${changeProfileData[i].innerHTML}">`;
    dataItem = document.querySelectorAll('.profile-data-input');
  };

  dataItem[0].setAttribute('name', 'name');
  dataItem[1].setAttribute('name', 'city');
  dataItem[2].setAttribute('name', 'age');

  changeProfileDataSelect.innerHTML = `
    <select class="select">
      <option value="1">Мужской</option>
      <option value="2">Женский</option>
    </select>`;

  select = document.querySelector('.select');
  select.setAttribute('name', 'sex');
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
};


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
    data: ({"token":$("#token").text(),"image":$(".profile-page-user-avatar-img").prop("src"),"age":$("input[name='age']").val(),"id_pol":$("select[name='sex']").val(),"city":$("input[name='city']").val(),"name":$("input[name='name']").val()}),
    dataType: "text",
    success: function (response) {
        res= JSON.parse(response);
        if (res.status == 403){

          alert('что то не так');
            return false;
        }
        saveDate();
        alert("сохранено")

    }
});

});

$("#save_vip").click(function () {
  $.ajax({
    type: "post",
    url: "/ajax/save/vip",
    dataType: "text",
    data: ({"token":$("#token").text(),"color":$('.left-profile-user-name.font-family-user-name').css('color'),"uved":$("#notification-check").prop("checked"),"status":$("textarea[name='status']").val(),"font":$("select.font-family-type").val()}),
    success: function (response) {
        res= JSON.parse(response);
        if (res.status == 403){
            alert('Авторизуйтесь пожалуйста');
            $('.form .disable').css('display','none')
            return false;
        }
        alert('Save');

    }
});

});
