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

// let subMenu = document.querySelector('.sub-menu');
//
// let q = false;
// // subMenu.addEventListener('mouseover', openSubMenu);
// // subMenu.addEventListener('mouseout', closeSubMenu);
//
// window.addEventListener('mousemove', function() {
//   subMenu.addEventListener('mousemove', function(event) {
//     if (event) {
//       q = true;
//     }
//   });
//   // qwer()
//   console.log(q);
//   // if (q) {
//   //   openSubMenu();
//   // } else {
//   //   closeSubMenu();
//   //   console.log(q);
//   // }
//   // q = false;
// });
//
// // subMenu.addEventListener('mousemove', function(event) {
// //   if (event) {
// //     q = true;
// //   } else {
// //     q = false;
// //   }
// // });
// //
// // subMenu.addEventListener('mousemove', function() {
// //   if (q) {
// //     openSubMenu();
// //   } else {
// //     closeSubMenu();
// //   };
// // })
//
// function qwer() {
//   if (q) {
//     openSubMenu()
//   } else {
//     closeSubMenu()
//   }
// }
//
// function openSubMenu() {
//   document.body.classList.add('open-sub-menu');
//   setTimeout(function () {
//     document.body.classList.add('opacity-sub-menu');
//   }, 10);
//   // q = false;
// };
//
// function closeSubMenu() {
//   document.body.classList.remove('opacity-sub-menu');
//   setTimeout(function () {
//     document.body.classList.remove('open-sub-menu');
//   }, 500);
// };
