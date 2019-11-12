let profile = document.querySelector('#profile-button');
let exitProfile = document.querySelector('.exit-profile');

let signIn = document.querySelector('#sign-in-button');
let exitSignIn = document.querySelector('.exit-sign-in');

profile.addEventListener('click', openProfile);
exitProfile.addEventListener('click', closeProfile);

signIn.addEventListener('click', openSignIn);
exitSignIn.addEventListener('click', closeSignIn);

function openProfile() {
  document.body.classList.add('open-profile');
  setTimeout(function () {
    document.body.classList.add('sign-in-opacity');
  }, 0);
};

function closeProfile() {
  document.body.classList.remove('sign-in-opacity');
  setTimeout(function () {
    document.body.classList.remove('open-profile');
  }, 500);
};

function openSignIn() {
  document.body.classList.add('sign-in');
  setTimeout(function () {
    document.body.classList.add('sign-in-opacity');
  }, 0);
};

function closeSignIn() {
  document.body.classList.remove('sign-in-opacity');
  setTimeout(function () {
    document.body.classList.remove('sign-in');
  }, 500);
};
