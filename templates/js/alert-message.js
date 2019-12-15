let messagePlace = document.querySelector('.message-place');

let closeMessage;
let allMes = [];
let crossLength = [];

let error = 'error-message';
let successful = 'successful-message';

function showMessage(name, discription, typeMessage) {
  createMessage(name, discription, typeMessage)

  closeMessage = document.querySelectorAll('.alert-cross');
  closeMessage.forEach((elem, index) => {
    elem.onclick = () => {
      let alertMessageBlock = document.querySelectorAll('.alert-message-block')
      alertMessageBlock[index].classList.remove('show-alert');
      setTimeout(function () {

        elem.parentNode.remove()
      }, 500);
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

  for (let i = 0; i < allMes.length; i++) {
    messagePlace.append(allMes[i]);
  };
};
