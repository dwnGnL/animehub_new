let seriesList = document.querySelector('.series-list');
let seriesItem = document.querySelectorAll('.series-item');
let seriesBlock = document.querySelector('.series-block');
let toLeftSeries = document.querySelector('.to-left-series');
let toRightSeries = document.querySelector('.to-right-series');
let topVideoBlock = document.querySelector('.top-video-block');
let searchSeries = document.querySelector('.search-series');
let searchInput = document.getElementById('search-input');
let videoLink = document.querySelector('.video');
let openSearch = true;
let seriesListWidth = 0;
let previousSeries = 0;
let presentSeries = 0;

toRightSeries.addEventListener('click', () => scrollingSeries(-(seriesItem[0].offsetWidth + 10)));
toLeftSeries.addEventListener('click', () => scrollingSeries(seriesItem[0].offsetWidth + 10));
searchSeries.addEventListener('click', showHideSearch);

seriesItem.forEach(function (elem, index) {
  seriesListWidth += elem.offsetWidth + 10;

  elem.onclick = () => {
    previousSeries = presentSeries;
    presentSeries = index;
    seriesItem[previousSeries].classList.remove('series-item-active');
    seriesItem[presentSeries].classList.add('series-item-active');
    videoLink.src = elem.getAttribute('src');
  };
});

seriesList.style.width = `${seriesListWidth + 10}px`;

let sumSize = 0;
let maxTrans = -(seriesListWidth + 10) + seriesBlock.offsetWidth;
let mousePressing, mouseUnPressing, posInt, positions, sumPos;

toRightSeries.onmousedown = toRightSeries.ontouchstart = () => {
  mouseUnPressing = setTimeout(() => {
    setPosition();
    mousePressing = setInterval (() => scrollingSeries(-sumPos), 100);
  }, 50)
};

toLeftSeries.onmousedown = toLeftSeries.ontouchstart = () => {
  mouseUnPressing = setTimeout(() => {
    setPosition();
    mousePressing = setInterval (() => scrollingSeries(sumPos), 100);
  }, 50);
};

function setPosition() {
  positions = 0;
  sumPos = 0;
  setTimeout(() => seriesList.style.transition = '.2s', 1500);

  posInt = setInterval(() => {
    positions++
    sumPos += positions
  }, 100);
};

toRightSeries.onmouseup = toLeftSeries.onmouseup = toRightSeries.ontouchend = toLeftSeries.ontouchend = () => {
  seriesList.style.transition = '.5s'
  clearTimeout (mouseUnPressing);
  clearInterval (mousePressing);
  clearInterval (posInt);
};

function scrollingSeries(size) {
  sumSize += size;
  if (sumSize <= maxTrans) sumSize = maxTrans;
  if (sumSize > 0) sumSize = 0
  seriesList.style.transform = `translateX(${sumSize}px)`;
};

function showHideSearch() {
  searchInput.value == '' && !openSearch ? hideSearch() : showSearch();
};

function showSearch() {
  topVideoBlock.classList.add('show-search-series');
  setTimeout(() => {
    topVideoBlock.classList.add('show-opacity-search-series');
    openSearch = false;
  }, 0);
};

function hideSearch() {
  topVideoBlock.classList.remove('show-opacity-search-series');
  setTimeout(() => {
    topVideoBlock.classList.remove('show-search-series');
    openSearch = true;
  }, 500);
};

let startSearch = document.querySelector('.start-search');
startSearch.onclick = () => searchSeriesItem();

function searchSeriesItem() {

  for (var i = 0; i < seriesItem.length; i++) {
    if (seriesItem[i].getAttribute('id-ser') == searchInput.value) break
  };
  console.log(seriesItem[i].innerHTML);

  // console.log(searchInput.value);

};




var id_post = document.location.pathname.split('/')
id_post = id_post[id_post.length-1].split('-')[0]

$("#like").click(()=>{
  raiting(1, id_post)
})

$("#dislike").click(()=>{
  raiting(0, id_post)

})

function raiting(type,id) {
  $.ajax({
    type: "post",
    url: "/ajax/voted/rating",
    data: ({"type":type,"id_post":id,"token":$("#token").text()}),
    dataType: "text",
    success: function (response) {
      response=JSON.parse(response)
      switch (response.status) {
        case "1":

        if (type==1) {
          $("#like span").html(parseInt($("#like span").text())+1)
        } else {
          $("#dislike span").html(parseInt($("#dislike span").text())-1)

        }

        break;
        case "0":
        alert("вы уже голосовали")
        break;
        case "403":
        alert("авторизуйтесь")
        break;
        default:
        alert("что то пошло не так")
        break;
      }
    }
  })
}
