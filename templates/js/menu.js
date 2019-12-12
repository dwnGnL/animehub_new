let subMenu = document.querySelector('.sub-menu');
let menuButton = document.querySelector('#menu-button');
let backgroundMenu = document.querySelector('.background-menu');

subMenu.addEventListener('mouseenter', openSubMenu);
subMenu.addEventListener('mouseleave', closeSubMenu);
menuButton.addEventListener('click', openMenu);
backgroundMenu.addEventListener('click', closeMenu);

function openSubMenu() {
  document.body.classList.add('open-sub-menu');
  setTimeout(() => document.body.classList.add('opacity-sub-menu'), 10);
};

function closeSubMenu() {
  document.body.classList.remove('opacity-sub-menu');
  setTimeout(() => document.body.classList.remove('open-sub-menu'), 500);
};

function openMenu() {
  document.body.classList.add('open-menu');
  backgroundMenu.style.display = 'block';
  setTimeout(() => document.body.classList.add('background-opacity'), 0);
};

function closeMenu() {
  document.body.classList.remove('background-opacity');
  document.body.classList.remove('open-menu');
  setTimeout(() => backgroundMenu.style.display = 'none', 500);
};
