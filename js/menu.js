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

let subMenu = document.querySelector('.sub-menu');

subMenu.addEventListener('mouseover', openSubMenu);
subMenu.addEventListener('mouseout', closeSubMenu);

function openSubMenu() {
  document.body.classList.add('open-sub-menu');
  setTimeout(function () {
    document.body.classList.add('opacity-sub-menu');
  }, 0);
}

function closeSubMenu() {
  document.body.classList.remove('opacity-sub-menu');
  // setTimeout(function () {
    document.body.classList.remove('open-sub-menu');
  // }, 500);
}
