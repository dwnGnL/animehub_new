let seriesList = document.querySelector('.series-list');
let seriesItem = document.querySelectorAll('.series-item');
let seriesBlock = document.querySelector('.series-block');
let toLeftSeries = document.querySelector('.to-left-series');
let toRightSeries = document.querySelector('.to-right-series');
let topVideoBlock = document.querySelector('.top-video-block');
let searchSeries = document.querySelector('.search-series');
let searchInput = document.getElementById('search-input');
let videoLink = document.querySelector('.video');
let favorite = document.querySelector('.favorites');
let searchSeriesInput = document.querySelector('.search-series-input');
let favoriteText = document.querySelector('.favorite-text');
let showAllSeries = document.querySelector('.show-all-series-post');
let closeSeriesPost = document.querySelector('.fa-reply-all');
let openSearch = true;
let seriesListWidth = 0;
let previousSeries = 0;
let presentSeries = 0;
let title = document.title;
favorite.classList.contains('choose') ? favoriteText.innerHTML = 'Удалить из избранного' : favoriteText.innerHTML = 'Добавить в избранное';

favorite.onclick = () => {
  if (!favorite.classList.contains('choose')) {
    $.ajax({
      type: "post",
      url: "/ajax/favorites/add",
      data: ({ "id_post": id_post, "token": $("#token").text() }),
      dataType: "text",
      success: function (response) {
        response = JSON.parse(response);
        switch (response.status) {
          case "401":
          showMessage("Ошибка", "авторизуйтесь прежде чем добавлять в закладки", error)
          break;
          case "200":
          favorite.classList.toggle('choose');
          favorite.classList.contains('choose') ? favoriteText.innerHTML = 'Удалить из избранного' : favoriteText.innerHTML = 'Добавить в избранное';
          break;
          default:
          showMessage("Ошибка", "что то пошло не так", error)
          break;
        }
      }
    })
  } else {
    $.ajax({
      type: "post",
      url: "/ajax/favorites/delete",
      data: ({ "id_post": id_post, "token": $("#token").text() }),
      dataType: "text",
      success: function (response) {
        response = JSON.parse(response);
        switch (response.status) {
          case "401":
          showMessage("Ошибка", "авторизуйтесь прежде чем добавлять в закладки", error)
          break;
          case "200":
          favorite.classList.toggle('choose');
          favorite.classList.contains('choose') ? favoriteText.innerHTML = 'Удалить из избранного' : favoriteText.innerHTML = 'Добавить в избранное';
          break;
          default:
          showMessage("Ошибка", "что то пошло не так", error);
          break;
        }
      }
    })
  }
};

toRightSeries.addEventListener('click', () => scrollingSeries(-(seriesItem[0].offsetWidth + 10)));
toLeftSeries.addEventListener('click', () => scrollingSeries(seriesItem[0].offsetWidth + 10));
searchSeries.addEventListener('click', showHideSearch);
let seriesData = []

seriesItem.forEach(function (elem, index) {

  seriesData.push({
    seriaNum: elem.getAttribute("id-ser"),
    seriaHtml: elem.outerHTML
  });
});

videoLink.removeAttribute("autoplay");
videoLink.src=seriesItem[0].getAttribute('src');

function addEvent(){
  seriesItem = document.querySelectorAll('.series-item');
  seriesItem.forEach(function (elem, index) {
    seriesListWidth += elem.offsetWidth + 10;
    elem.onclick = () => {
      videoLink.setAttribute("autoplay","true")
      previousSeries = presentSeries;
      presentSeries = index;
      seriesItem[previousSeries].classList.remove('series-item-active');
      seriesItem[presentSeries].classList.add('series-item-active');
      document.title = `${title} ${$(".film-discription-header").text()} | ${elem.textContent}`;
      videoLink.src = elem.getAttribute('src');
      closeSeriesListPost();
    };
  });
  if (document.body.clientWidth > 767) { seriesList.style.width = `${seriesListWidth + 10}px`};
};

addEvent();

let sumSize = 0;
let maxTrans = -(seriesListWidth + 10) + seriesBlock.offsetWidth;
let mousePressing, mouseUnPressing, posInt, positions, sumPos;

toRightSeries.onmousedown = toRightSeries.ontouchstart = () => {
  mouseUnPressing = setTimeout(() => {
    setPosition();
    mousePressing = setInterval(() => scrollingSeries(-sumPos), 100);
  }, 50);
};

toLeftSeries.onmousedown = toLeftSeries.ontouchstart = () => {
  mouseUnPressing = setTimeout(() => {
    setPosition();
    mousePressing = setInterval(() => scrollingSeries(sumPos), 100);
  }, 50);
};

function setPosition() {
  positions = 0;
  sumPos = 0;
  setTimeout(() => seriesList.style.transition = '.2s', 1500);

  posInt = setInterval(() => {
    positions++;
    sumPos += positions;
  }, 100);
};

toRightSeries.onmouseup = toLeftSeries.onmouseup = toRightSeries.ontouchend = toLeftSeries.ontouchend = () => {
  seriesList.style.transition = '.5s'
  clearTimeout(mouseUnPressing);
  clearInterval(mousePressing);
  clearInterval(posInt);
};

function scrollingSeries(size) {
  sumSize += size;
  if (sumSize <= maxTrans) sumSize = maxTrans;
  if (sumSize > 0) sumSize = 0;
  seriesList.style.transform = `translateX(${sumSize}px)`;
};

function showHideSearch() {
  !openSearch ? hideSearch() : showSearch();
};

function showSearch() {
  topVideoBlock.classList.add('show-search-series');
  setTimeout(() => {
    topVideoBlock.classList.add('show-opacity-search-series');
    openSearch = false;
  }, 0);
};

function hideSearch() {
  // searchInput.value = '';
  searchInputBlur();
  topVideoBlock.classList.remove('show-opacity-search-series');
  setTimeout(() => {
    topVideoBlock.classList.remove('show-search-series');
    openSearch = true;
  }, 500);
};

searchInput.oninput = () => search(searchInput.value);

function search(val) {
  if (val == ""){
    changeSeriaList(seriesData);
  } else {
    var newSeriasData = [];
    seriesData.forEach((elem,index) => {
      if (elem.seriaNum == val) newSeriasData.push(elem);
    });
    changeSeriaList(newSeriasData);
  };
  sumSize = 0;
  scrollingSeries(0);
  addEvent();
};

function changeSeriaList(elems) {
  let list = ""
  elems.forEach((elem, index) => {
    list += elem.seriaHtml;
  });
  seriesList.innerHTML = list;
};

// function searchSeriesItem() {
  //   let i = 0;
  //   for (i; i < seriesItem.length; i++) {
    //     if (seriesItem[i].getAttribute('id-ser') >= +searchInput.value) break;
    //   };
    //
    //   if (i >= seriesItem.length) showMessage('Ошибка!', 'Серия не найдена', error);
    //
    //   let sumScroll = seriesItem[i].getBoundingClientRect().x - toLeftSeries.getBoundingClientRect().right;
    //   scrollingSeries(-sumScroll);
    // };


searchInput.onfocus = () => searchSeriesInput.classList.add('search-series-focus');
searchInput.onblur = searchInputBlur;

function searchInputBlur() {
  if(searchInput.value == ''){
    searchSeriesInput.classList.remove('search-series-focus')
  }
};


let postSearch = document.querySelector('.post-search');
let placeholderPost = document.querySelector('.placeholder-post');
let seriesMainList = document.querySelector('.series-main-list');

postSearch.oninput = () => search(postSearch.value);

postSearch.onfocus = () => placeholderPost.classList.add('focus');
postSearch.onblur = () => {
  if (postSearch.value !== '') return;
  placeholderPost.classList.remove('focus');
};

showAllSeries.onclick = () => {
  seriesMainList.classList.add('show');
  document.body.style.overflow = 'hidden';
};

closeSeriesPost.onclick = closeSeriesListPost;

function closeSeriesListPost() {
  seriesMainList.classList.remove('show');
  // postSearch.value = '';
  document.body.style.overflow = 'auto';
};


var id_post = document.location.pathname.split('/')
id_post = id_post[id_post.length - 1].split('-')[0]

$("#like").click(() => {
  raiting(1, id_post)
})

$("#dislike").click(() => {
  raiting(0, id_post)
})

function raiting(type, id) {
  $.ajax({
    type: "post",
    url: "/ajax/voted/rating",
    data: ({ "type": type, "id_post": id, "token": $("#token").text() }),
    dataType: "text",
    success: function (response) {
      response = JSON.parse(response);
      switch (response.status) {
        case "1":

        if (type == 1) {
          $("#like span").html(parseInt($("#like span").text()) + 1)
        } else {
          $("#dislike span").html(parseInt($("#dislike span").text()) - 1)
        }
        break;
        case "0":
        showMessage("Ошибка", "Вы уже голосовали", error);
        break;
        case "403":
        showMessage("Ошибка", "Авторизуйтесь", error);
        break;
        default:
        showMessage("Ошибка", "что то пошло не так", error);
        break;
      }
    }
  })
};
