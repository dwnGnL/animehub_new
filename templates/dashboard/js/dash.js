let defaultButtonPlace = document.querySelectorAll('.default-buttons');
let editButtonPlace = document.querySelectorAll('.edit-buttons');

let editDataButton = document.querySelectorAll('.edit-table-data');
let removeDataButton = document.querySelectorAll('.remove-table-data');

let saveDataButton = document.querySelectorAll('.save-table-data');
let cancelDataButton = document.querySelectorAll('.cancel-table-data');

let tableRowData = document.querySelectorAll('.table-row-data');

let title = document.querySelectorAll('.inner-title');
let imgSrc = document.querySelectorAll('.img-src-data');
let season = document.querySelectorAll('.season-data');

let changeDataInputTitle = document.querySelectorAll('.change-data-title');
let changeDataInputIMG = document.querySelectorAll('.change-data-img');
let changeDataInputSeason = document.querySelectorAll('.change-data-season');



editDataButton.forEach((elem, index) => {
  elem.onclick = () => {
    tableRowData[index].classList.add('active-change');

    changeDataInputTitle[index].value = title[index].textContent;
    changeDataInputIMG[index].value = imgSrc[index].textContent;
    changeDataInputSeason[index].value = season[index].textContent;
  };
});


saveDataButton.forEach((elem, index) => {
  elem.onclick = () => {
    tableRowData[index].classList.remove('active-change');

    title[index].innerHTML = changeDataInputTitle[index].value;
    imgSrc[index].innerHTML = changeDataInputIMG[index].value;
    season[index].innerHTML = changeDataInputSeason[index].value;
  };
});

cancelDataButton.forEach((elem, index) => {
  elem.onclick = () => {
    tableRowData[index].classList.remove('active-change');
  };
});
