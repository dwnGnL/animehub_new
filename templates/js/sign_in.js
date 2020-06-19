let profile = document.querySelector('#profile-button');
let exitProfile = document.querySelector('.exit-profile');

let signIn = document.querySelector('#sign-in-button');
let exitSignIn = document.querySelector('.exit-sign-in');

if (profile) {
  profile.addEventListener('click', openProfile);
  exitProfile.addEventListener('click', closeProfile);
};

if (signIn) {
  signIn.addEventListener('click', openSignIn);
  exitSignIn.addEventListener('click', closeSignIn);
};

function openProfile() {
  document.body.classList.add('open-profile');
  setTimeout(() => document.body.classList.add('sign-in-opacity'), 0);
};

function closeProfile() {
  document.body.classList.remove('sign-in-opacity');
  setTimeout(() => document.body.classList.remove('open-profile'), 500);
};

function openSignIn() {
  document.body.classList.add('sign-in');
  setTimeout(() => document.body.classList.add('sign-in-opacity'), 0);
};

function closeSignIn() {
  document.body.classList.remove('sign-in-opacity');
  setTimeout(() => document.body.classList.remove('sign-in'), 500);
};


let signInInput = document.querySelectorAll('.sign-in-input');
let mainInput = document.querySelectorAll('.sign-in-input-item');
let registInput = document.querySelectorAll('.registration-input');
let mainRegistInput = document.querySelectorAll('.registration-input-item');

mainInput.forEach((elem, index) => inputFocus(elem, index, signInInput, 'sign-in-input-focus'));
mainRegistInput.forEach((elem, index) => inputFocus(elem, index, registInput, 'registration-input-focus'));

function inputFocus(elem, index, inputItem, classFocus) {
  elem.onfocus = () => inputItem[index].classList.add(classFocus);
  elem.onblur = () => elem.value == '' ? inputItem[index].classList.remove(classFocus) : elem;
};

var videos = document.querySelectorAll(".comment-text video")
videos.forEach(element => {
  element.remove()
});