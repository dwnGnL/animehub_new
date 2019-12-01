let updateName = document.querySelectorAll('.update-name');
let topWeakFilmName = document.querySelectorAll('.top-weak-film-name');
let commentsNameFilm = document.querySelectorAll('.comments-name-film');

shortingText(updateName, 13);
shortingText(topWeakFilmName, 20);
shortingText(commentsNameFilm, 25);

function shortingText(elem, length) {
  for (let i = 0; i < elem.length; i++) {
    if (elem[i].innerHTML.length >= length) {
      elem[i].innerHTML = elem[i].innerHTML.substr(0, length) + '...';
    };
  };
};
