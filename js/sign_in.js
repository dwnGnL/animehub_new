let signIn = document.querySelector('#sign-in');
let exitSignIn = document.querySelector('.exit-sign-in');

signIn.addEventListener('click', openSignIn);
exitSignIn.addEventListener('click', closeSignIn);

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
