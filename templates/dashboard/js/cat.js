const searchBlock = document.querySelector('.search-block-main');
const listData = document.querySelectorAll('.list-item');
let search = document.querySelector('.search-input');
let findingElemBlock = document.querySelector('.finding__elem-block');
let arrData = new Array;
let array = new Array;
let unchooes;


listData.forEach(elem => array.push(elem.innerHTML.toLowerCase()));

search.oninput = () => searchItems(false)

search.onpaste = () => {
  setTimeout(() => searchItems(true), 0)
};

listData.forEach((elem, index) => {
  elem.onclick = () => addFindElement(elem, index);
});

function searchItems(pasteEevnt) {
  arrData = search.value.split(',');
  arrData = arrDataFix(arrData);
  
  array.forEach((elem, index) => {
    listData[index].classList.remove('show');
    arrData.forEach(searchElem => {
      if (elem.indexOf(searchElem) > - 1) { 
        listData[index].classList.add('show');
        if (pasteEevnt) addFindElement(listData[index], index); 
      };
    });
  });
};

function addFindElement(elem, index) {
  if (elem.classList.contains('choosed')) return;

  elem.classList.add('choosed');

  createFindElem(elem, index);

  unchooes = document.querySelectorAll('.cross');
  unchooes.forEach((elem) => {
    elem.onclick = () => unchooesEleme(elem, elem.dataset.index);
  });
  search.value = '';
};


function arrDataFix(arr) {
  const arrFixed = arr.map((elem) => {
    elem = elem.replace(/\s+/g, " ");
    elem = elem.trim();
    if (elem === '' || elem === undefined) return;
    return elem.substr(0).toLowerCase();
  });  
  return arrFixed;
};

function createFindElem(elem, index) {
  const findElem = document.createElement('span');
  findElem.classList.add('finding__elem');
  findElem.innerHTML = `${elem.innerHTML}<span class="cross" data-index="${index}"></span>`;

  findingElemBlock.appendChild(findElem);
  controlInputWidth();
}

function unchooesEleme(elem, index) {
  elem.parentNode.remove();
  listData[index].classList.remove('choosed');
  controlInputWidth();
};


function controlInputWidth() {
  let inputWidth = searchBlock.clientWidth - findingElemBlock.clientWidth - 5;
  let inputHeight = findingElemBlock.clientHeight;
  console.log(inputHeight);
  
  if (inputHeight < 36) inputHeight = 36;
  search.style.width = `${inputWidth}px`;
  search.style.height = `${inputHeight}px`;
}



