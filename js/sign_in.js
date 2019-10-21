let signIn = document.querySelector('#sign-in');
let exitSignIn = document.querySelector('.exit-sign-in');

signIn.addEventListener('click', openSignIn);
exitSignIn.addEventListener('click', closeSignIn);

function openSignIn() {
  document.body.classList.add('sign-in');
}

function closeSignIn() {
  document.body.classList.remove('sign-in');
}
