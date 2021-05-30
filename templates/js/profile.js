// Choose avater
let chooseAvatarBlock = document.querySelector('.choose-avatar');

for (var i = 0; i < 100; i++) {
  chooseAvatarBlock.innerHTML += '<div class="choose-avatar-item"><img class="choose-avatar-img" src="'+location.origin+'/templates/images/avatar/' + (i + 1) + '.png"></div>';
};

let chooseAvatar = document.querySelector('.left-profile');
let changeAvatar = document.querySelector('.profile-page-user-avatar');
let chooseAvatarImg = document.querySelectorAll('.choose-avatar-img');
let choosedIMG = document.querySelector('.profile-page-user-avatar-img');

// changeAvatar.addEventListener('click', openCooseAvatar);

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
if (accountButton && vipSettingButton){
    accountButton.addEventListener('click', () => togglePage('show-account', 'show-vip-setting', 'account-opacity', 'vip-setting-opacity'));
    vipSettingButton.addEventListener('click', () => togglePage('show-vip-setting', 'show-account', 'vip-setting-opacity', 'account-opacity'));
}
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
let dataItem, dataSelectItem, select;
let givedDate = [];

changeButton.addEventListener('click', changeDate);

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
if (saveVip){
saveVip.addEventListener('click', saveingVip);
}

function saveingVip() {
  fontFamilyUserName.style.fontFamily = fontFamilyType.value;
};



let choosedBG = document.querySelector('.choosed-bg');
let choosingBG = document.querySelector('.choosing-bg');
let bgItem = document.querySelectorAll('.bg-item');
if(choosedBG && choosingBG && bgItem){
choosedBG.style.backgroundImage=choosedBG.getAttribute("data-src")
choosedBG.onclick = () => {
  if (choosedBG.classList.contains('show-bg-list')) return;
  choosedBG.classList.add('show-bg-list');
  setTimeout(() => choosingBG.classList.add('show-bg-list'), 0);
};

bgItem.forEach((elem, index) => {
  elem.style.backgroundImage=`url(${elem.dataset.src})`
  elem.onclick = () => {
    choosedBG.style.backgroundImage = `url(${elem.dataset.src})`;
    choosingBG.classList.remove('show-bg-list');
    setTimeout(() => choosedBG.classList.remove('show-bg-list'), 500);
  };
});

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
    data: ({"token":$("#token").text(),"age":$("input[name='age']").val(),"id_pol":$("select[name='sex']").val(),"city":$("input[name='city']").val(),"name":$("input[name='name']").val()}),
    dataType: "text",
    success: function (response) {
      res= JSON.parse(response);
      if (res.status == 403){

        alert('что то не так');
        return false;
      }
      saveDate();
      showMessage("OK",'Сохранено',successful)
    }
  });
});

$("#save_vip").click(function () {

  $.ajax({
    type: "post",
    url: "/ajax/save/vip",
    dataType: "text",
    data: ({"token":$("#token").text(),"back_fon":choosedBG.style.backgroundImage,"color":$('.left-profile-user-name.font-family-user-name').css('color'),"uved":$("#notification-check").prop("checked"),"status":$("textarea[name='status']").val(),"font":$("select.font-family-type").val()}),
    success: function (response) {
      res= JSON.parse(response);
      if (res.status == 403){
        alert('Авторизуйтесь пожалуйста');
        $('.form .disable').css('display','none')
        return false;
      }
      showMessage("OK",'Сохранено',successful)
    }
  });
});

$('.profile-page-user-avatar').click(function () {
  $('#chose-image').click()
})

function errors(data) {
  var status = data.status
  if (status === 400) {
    var errors = data.responseJSON.errors,
        html = ''
    for (var key in errors) {
      errors[key].forEach(function (value) {
        html += `<p>${value}</p>`
      })
    }
    showMessage('Ошибка!', html, error)
  }
}

$('#chose-image').change(async function (e) {
  $('.profile-page-user-avatar-img').hide()
  $('#avatar_loader').show()
  const js_info = $('#js-info')
  const salt = js_info.attr('data-salt')
  const id = js_info.attr('data-id')
  var file = e.target.files[0];
  var imageType = /image.*/;

  if (!file.type.match(imageType)) return;

  var formData = new FormData();
  formData.append('image', file);
  formData.append('token', salt);
  formData.append('user_id', id);

  $.ajax({
    url: `${BASE_API}/profile/upload_image`,
    data: formData,
    processData: false,
    contentType: false,
    crossDomain: true,
    type: 'POST',
    success: function(data){
      $('.profile-page-user-avatar-img').attr('src', `${BASE_URL}/${data}`)
      showMessage("OK",'Аватар успешно изменен',successful)
    },
    error: function (response) {
        errors(response)
    },
    complete:function (response) {
      $('#avatar_loader').hide()
      $('.profile-page-user-avatar-img').show()
    }
  });
})

function getBase64(file) {
  var reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = function () {
    reader.result
  };
  reader.onerror = function (error) {
    console.log('Error: ', error);
  };
  return  reader.result
}

async function request(endpoint, method = 'GET', body = {}, headers = {}){
    return  fetch(`${BASE_API}/${endpoint}`, {
    method: method, // *GET, POST, PUT, DELETE, etc.
    mode: 'no-cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
          ...headers
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *client
    body: body// body data type must match "Content-Type" header
  });

}
