let messagePlace = document.querySelector('.message-place');
let closeMessage;
let allMes = new Array;
let crossLength = new Array;
const BODY = $('body');
const error = 'error-message';
const successful = 'successful-message';
const BASE_API = BODY.data('api');
const BASE_URL = BODY.data('url');


function showMessage(name, discription, typeMessage) {
  createMessage(name, discription, typeMessage);

  let alertMessageBlock = document.querySelectorAll('.alert-message-block')
  closeMessage = document.querySelectorAll('.alert-cross');

  closeMessage.forEach((elem, index) => {
    elem.onclick = () => {
      alertMessageBlock[index].classList.remove('show-alert');
      allMes = [];
      setTimeout(() => elem.parentNode.remove(), 500);
    };
  });
};

function createMessage(name, discription, typeMessage) {
  let mes = document.createElement('div');
  mes.classList.add('alert-message-block');
  mes.innerHTML =
  `
    <div class="alert-message-top"><div class="message-name">${name}</div></div>
    <div class="alert-cross">
      <div class="alert-cross-line"></div>
      <div class="alert-cross-line"></div>
    </div>
    <div class="alert-message-body">${discription}</div>
  `;

  setTimeout(() => {
    mes.classList.add('show-alert');
    mes.classList.add(typeMessage);
    crossLength.push(closeMessage);
  }, 0);

  allMes.push(mes);

  let qwer = document.querySelectorAll('.alert-message-block');

  if (allMes.length > 1) {
    allMes.shift();
    qwer[qwer.length - 1].classList.remove('show-alert');
    setTimeout(() => qwer[qwer.length - 1].remove(), 500);
  };

  for (let i = 0; i < allMes.length; i++) {
    messagePlace.append(allMes[i]);
  };
};
