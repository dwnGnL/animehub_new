let seriesList = document.querySelector('.series-list');
let seriesItem = document.querySelectorAll('.series-item');
let seriesNumber = document.querySelectorAll('.series-number');
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

toRightSeries.addEventListener('click', () => scrollingSeries(seriesItem[0].offsetWidth + 10));
toLeftSeries.addEventListener('click', () => scrollingSeries(-(seriesItem[0].offsetWidth + 10)));
searchSeries.addEventListener('click', showHideSearch);

seriesItem.forEach(function (elem, index) {
  seriesNumber[index].innerHTML = index + 1;
  seriesListWidth += elem.offsetWidth + 10;

  elem.onclick = () => {
    previousSeries = presentSeries;
    presentSeries = index;
    seriesItem[previousSeries].classList.remove('series-item-active');
    seriesItem[presentSeries].classList.add('series-item-active');
  };
});

seriesList.style.width = `${seriesListWidth + 10}px`;


function scrollingSeries(size) {
  seriesBlock.scrollBy(size * 2, 0)
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


seriesBlock.onmousewheel = seriesBlock.onwheel = seriesBlock.onMozMousePixelScroll = function (event) {
  seriesBlock.scrollBy(event.deltaX, 0)
}
