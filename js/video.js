let seriesList = document.querySelector('.series-list');
let seriesItem = document.querySelectorAll('.series-item');
let seriesNumber = document.querySelectorAll('.series-number');
let seriesListWidth = 0;
let previousSeries = 0;
let presentSeries = 0;

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

seriesList.style.width = `${seriesListWidth}px`;
