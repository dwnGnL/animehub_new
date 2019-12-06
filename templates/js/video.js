let seriesList = document.querySelector('.series-list');
let seriesItem = document.querySelectorAll('.series-item');
let seriesBlock = document.querySelector('.series-block');
let toLeftSeries = document.querySelector('.to-left-series');
let toRightSeries = document.querySelector('.to-right-series');
let topVideoBlock = document.querySelector('.top-video-block');
let searchSeries = document.querySelector('.search-series');
let searchInput = document.getElementById('search-input');
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
  };
});

seriesList.style.width = `${seriesListWidth + 10}px`;



// -----------------
let sumSize = 0;

let mousePressing;
let mouseUnPressing;

toRightSeries.onmousedown = function() {
  mouseUnPressing = setTimeout(function() {
    mousePressing = setInterval (function () {
      qrew(-((seriesItem[0].offsetWidth * 2) + 10))
    }, 100);
  }, 500)
};

toLeftSeries.onmousedown = function() {
  mouseUnPressing = setTimeout(function() {
    mousePressing = setInterval (function () {
      qrew((seriesItem[0].offsetWidth * 2) + 10)
    }, 100);
  }, 500)
};

toRightSeries.onmouseup = toLeftSeries.onmouseup = function(){
  clearTimeout (mouseUnPressing);
  clearInterval (mousePressing);
  seriesList.style.transition = '.5s'
};

function qrew(size) {
  console.log('fadad');
  seriesList.style.transition = '.1s'
  scrollingSeries(size)
}


function scrollingSeries(size) {
  sumSize += size

  if (sumSize <= -(seriesListWidth + 10) + seriesBlock.offsetWidth) {
    sumSize = -(seriesListWidth + 10) + seriesBlock.offsetWidth;
  }

  if (sumSize > 0) {
    sumSize = 0
  }

  seriesList.style.transform = `translateX(${sumSize}px)`;
};

// -----------------


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


seriesBlock.onmousewheel = seriesBlock.onwheel = seriesBlock.onMozMousePixelScroll = function (event) {
  seriesBlock.scrollBy(event.deltaX, 0)
}
