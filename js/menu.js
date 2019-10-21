let menuButton = document.querySelector('#menu-button');
let backgroundMenu = document.querySelector('.background-menu');

menuButton.addEventListener('click', openMenu);
backgroundMenu.addEventListener('click', closeMenu);

function openMenu() {
  document.body.classList.add('open-menu');
  backgroundMenu.style.display = 'block';
  setTimeout(function () {
    document.body.classList.add('background-opacity');
  }, 0);
};

function closeMenu() {
  document.body.classList.remove('background-opacity');
  document.body.classList.remove('open-menu');
  setTimeout(function () {
    backgroundMenu.style.display = 'none';
  }, 500);
};
