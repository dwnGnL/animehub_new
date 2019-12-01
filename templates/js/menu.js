let subMenu = document.querySelector('.sub-menu');
let menuButton = document.querySelector('#menu-button');
let backgroundMenu = document.querySelector('.background-menu');

// let topMenuItem = document.querySelectorAll('.top-menu');
// let previousTopMenuItem = 0;
// let presentTopMenuItem = 0;

subMenu.addEventListener('mouseenter', openSubMenu);
subMenu.addEventListener('mouseleave', closeSubMenu);
menuButton.addEventListener('click', openMenu);
backgroundMenu.addEventListener('click', closeMenu);

// topMenuItem[0].classList.add('active-top-menu-item')

// topMenuItem.forEach((elem, index) => {
//   elem.onclick = () => {
//     previousTopMenuItem = presentTopMenuItem;
//     presentTopMenuItem = index;
//
//     topMenuItem[previousTopMenuItem].classList.remove('active-top-menu-item')
//     topMenuItem[presentTopMenuItem].classList.add('active-top-menu-item')
//   };
// });

function openSubMenu() {
  document.body.classList.add('open-sub-menu');
  setTimeout(function () {
    document.body.classList.add('opacity-sub-menu');
  }, 10);
};

function closeSubMenu() {
  document.body.classList.remove('opacity-sub-menu');
  setTimeout(function () {
    document.body.classList.remove('open-sub-menu');
  }, 500);
};

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
