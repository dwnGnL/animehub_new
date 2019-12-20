let notification = document.querySelector('#notification');
let notificationLength = document.querySelector('.notification-length');
let closeNotification = document.querySelector('.notification-cross');
let notificationItem = document.querySelectorAll('.notification-item');

notificationLength.innerHTML = `(${notificationItem.length})`

notification.onmouseenter = () => notification.style.left = `calc(100% - ${notification.clientWidth}px)`;
notification.onmouseleave = () => notification.style.left = `calc(100% - 35px)`;

notification.onclick = () => {
  document.body.classList.add('open-notification');
  setTimeout(() => document.body.classList.add('open-notification-opacity'), 0);
};

closeNotification.onclick = () => {
  document.body.classList.remove('open-notification-opacity');
  setTimeout(() => document.body.classList.remove('open-notification'), 500);
};


notificationItem.forEach((elem, index) => {
  elem.onclick = () => {
    elem.classList.toggle('open-notifications-item');
    elem.classList.contains('open-notifications-item') ? elem.style.height = `${elem.scrollHeight - 20}px` : elem.style.height = `27px`;
  };
});
