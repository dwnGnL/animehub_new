let notification = document.querySelector('#notification');
let notificationLength = document.querySelector('.notification-length');
let closeNotification = document.querySelector('.notification-cross');
let notificationItem = document.querySelectorAll('.notification-item');
let newNotification = document.querySelectorAll('.new-notification');
let showNotification = document.querySelectorAll('.notification-text');
let trash = document.querySelectorAll('.fa-trash');
let token = document.getElementById('token');


let prevNot, presNot = 0;

notificationLength.innerHTML = `(${newNotification.length})`;
notification.onmouseenter = () => notification.style.right = `calc(100% - ${notification.clientWidth}px)`;
notification.onmouseleave = () => notification.style.right = `calc(100% - 35px)`;

notification.onclick = () => {
  document.body.classList.add('open-notification');
  setTimeout(() => document.body.classList.add('open-notification-opacity'), 0);
};

closeNotification.onclick = () => {
  for (let i = 0; i < notificationItem.length; i++) {notificationItem[i].style.height = `35px`};
  document.body.classList.remove('open-notification-opacity');
  setTimeout(() => document.body.classList.remove('open-notification'), 500);
};

showNotification.forEach((elem, index) => {
  elem.onclick = () => {
    updateNotification(elem, index);
    setTimeout(() => viewNotification(elem, index), 10);
  };
});

function viewNotification(elem, index) {
  prevNot = presNot;
  presNot = index;

  notificationItem[index].classList.remove('new-notification');
  newNotification = document.querySelectorAll('.new-notification');

  notificationLength.innerHTML = `(${newNotification.length})`;

  notificationItem[index].classList.toggle('open-notifications-item');

  if (prevNot != presNot) notificationItem[prevNot].classList.remove('open-notifications-item');

  notificationItem[prevNot].classList.contains('open-notifications-item') ? notificationItem[prevNot].style.height = `${notificationItem[prevNot].scrollHeight - 20}px` : notificationItem[prevNot].style.height = `35px`;
  notificationItem[index].classList.contains('open-notifications-item') ? notificationItem[index].style.height = `${notificationItem[index].scrollHeight - 20}px` : notificationItem[index].style.height = `35px`;
}

trash.forEach((elem, index) => {
  elem.onclick = () => {
    // let removeItemData = {
    //   token: token.textContent,
    //   type: 1,
    //   id_not: notificationItem[index].id
    // };

    // let jsonItem = JSON.stringify(removeItemData);
    // console.log(removeItemData);


    fetch('/ajax/notification/delete', {
      method: 'POST',
      body: {
        "token":token.textContent,
        "type":1,
        "id_not":notificationItem[index].id
      }
    })
    .catch(err => {
      alert('Произошла ошибка. Пожалуйста, повторите позже' + err)
    })
  };
});


function updateNotification(elem, index) {
  if (!elem.parentNode.classList.contains('new-notification')) return

  // let updateItemData = {
  //   token: token.textContent,
  //   id_not: notificationItem[index].id
  // };

  fetch('/ajax/notification/update', {
    method: 'POST',
    body: {
      "token":token.textContent,
      "id_not":notificationItem[index].id
    }
  });
};
