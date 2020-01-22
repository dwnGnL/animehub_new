let updateName = document.querySelectorAll('.update-name');
let topWeakFilmName = document.querySelectorAll('.top-weak-film-name');
let commentsNameFilm = document.querySelectorAll('.comments-name-film');
let titleNotification = document.querySelectorAll('.title-notification');

resizeingShortingText();

function resizeingShortingText() {
  if (document.body.clientWidth > 992) {
    shortingText(updateName, 13);
    shortingText(commentsNameFilm, 25);
    shortingText(topWeakFilmName, 25);
  } else if (document.body.clientWidth > 767 && document.body.clientWidth < 992) {
    shortingText(updateName, 50);
    shortingText(commentsNameFilm, 80);
    shortingText(topWeakFilmName, 80);
  } else if (document.body.clientWidth > 550 && document.body.clientWidth < 767) {
    shortingText(updateName, 30);
    shortingText(commentsNameFilm, 60);
    shortingText(topWeakFilmName, 60);
  } else if (document.body.clientWidth < 550) {
    shortingText(updateName, 18);
    shortingText(commentsNameFilm, 35);
    shortingText(topWeakFilmName, 35);
  };
};

function shortingText(elem, length) {
  for (let i = 0; i < elem.length; i++) {
    if (elem[i].innerHTML.length >= length) {
      elem[i].innerHTML = elem[i].innerHTML.substr(0, length) + '...';
    };
  };
};
