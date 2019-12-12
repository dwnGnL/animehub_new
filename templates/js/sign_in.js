let profile = document.querySelector('#profile-button');
let exitProfile = document.querySelector('.exit-profile');

let signIn = document.querySelector('#sign-in-button');
let exitSignIn = document.querySelector('.exit-sign-in');

if (profile){
  profile.addEventListener('click', openProfile);
  exitProfile.addEventListener('click', closeProfile);
}

if (signIn){
  signIn.addEventListener('click', openSignIn);
  exitSignIn.addEventListener('click', closeSignIn);
}

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


let signInInput = document.querySelectorAll('.sign-in-input');
let mainInput = document.querySelectorAll('.sign-in-input-item');

mainInput.forEach((elem, index) => {
  elem.onfocus = () => {
    signInInput[index].classList.add('sign-in-input-focus')
  };

  elem.onblur = () => {
    if (elem.value == '') {
      signInInput[index].classList.remove('sign-in-input-focus')
    }
  };
})
