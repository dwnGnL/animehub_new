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


seriesItem[0].classList.add('series-item-active');
videoLink.src = seriesItem[0].getAttribute('src');

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


toRightSeries.onmousedown = () => {
  mouseUnPressing = setTimeout(() => {
    setPosition();
    mousePressing = setInterval (() => scrollingSeries(-sumPos), 100);
  }, 50)
};

toLeftSeries.onmousedown = () => {
  mouseUnPressing = setTimeout(() => {
    setPosition();
    mousePressing = setInterval (() => scrollingSeries(sumPos), 100);
  }, 50);
};

function setPosition() {
  positions = 0;
  sumPos = 0;

  setTimeout(() => {
    seriesList.style.transition = '.2s'
  }, 1500);

  posInt = setInterval(() => {
    positions++
    sumPos += positions
  }, 100);
}

toRightSeries.onmouseup = toLeftSeries.onmouseup = () => {
  seriesList.style.transition = '.5s'
  clearTimeout (mouseUnPressing);
  clearInterval (mousePressing);
  clearInterval (posInt);
};

function scrollingSeries(size) {
  sumSize += size;

  if (sumSize <= maxTrans) {
    sumSize = maxTrans;
  }

  if (sumSize > 0) {
    sumSize = 0
  }

  seriesList.style.transform = `translateX(${sumSize}px)`;
};

function showHideSearch() {
  searchInput.value == '' && !openSearch ? hideSearch() : showSearch();
};

function showSearch() {
  topVideoBlock.classList.add('show-search-series');
  setTimeout(function () {
    topVideoBlock.classList.add('show-opacity-search-series');
    openSearch = false;
  }, 0);
};

function hideSearch() {
  topVideoBlock.classList.remove('show-opacity-search-series');
  setTimeout(function () {
    topVideoBlock.classList.remove('show-search-series');
    openSearch = true;
  }, 500);
};

seriesBlock.onmousewheel = seriesBlock.onwheel = seriesBlock.onMozMousePixelScroll = event => {
  seriesBlock.scrollBy(event.deltaX, 0)
}
var id_post=document.location.pathname.split('/')
    id_post=id_post[id_post.length-1].split('-')[0]

$("#like").click(()=>{
  switch (raiting(1,id_post)) {
    case "1":
      $("#like span").html(parseInt($("#like span").text())+1)
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
})

$("#dislike").click(()=>{
  switch (raiting(0,id_post)) {
    case "1":
      $("#dislike span").html(parseInt($("#like span").text())-1)
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
})

function raiting(type,id){ 
  $.ajax({
    type: "post",
    url: "/ajax/voted/rating",
    data: ({"type":type,"id_post":id}),
    dataType: "text",
    success: function (response) {
        return response.status
    }
  })
 }