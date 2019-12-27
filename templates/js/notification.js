let notification = document.querySelector('#notification');
let deleteAllNotification = document.querySelector('.bottom-notification');
let notificationLength = document.querySelector('.notification-length');
let closeNotification = document.querySelector('.notification-cross');
let notificationItem = document.querySelectorAll('.notification-item');
let newNotification = document.querySelectorAll('.new-notification');
let showNotification = document.querySelectorAll('.notification-text');
let trash = document.querySelectorAll('.fa-trash');
let token = document.getElementById('token');

let notificationDescription = document.querySelectorAll('.notification-description');
let prevNot, presNot = 0;
if(notification!==null){
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

  if (notificationItem[prevNot].classList.contains('open-notifications-item')) {
    notificationItem[prevNot].style.height = `${notificationItem[prevNot].scrollHeight - 20}px`;
    notificationDescription[prevNot].classList.add('show-notification-description');
  } else {
    notificationItem[prevNot].style.height = `35px`
    notificationDescription[prevNot].classList.remove('show-notification-description');
  };

  if (notificationItem[index].classList.contains('open-notifications-item')) {
    notificationItem[index].style.height = `${notificationItem[index].scrollHeight - 20}px`;
    notificationDescription[index].classList.add('show-notification-description');
  } else {
    notificationItem[index].style.height = `35px`
    notificationDescription[index].classList.remove('show-notification-description');
  };
};

trash.forEach((elem, index) => {
  elem.onclick = () => {
    $.ajax({
      type: "post",
      url: "/ajax/notification/delete",
      data: ({"type":1,"token":$("#token").text(),"id_not":notificationItem[index].id}),
      dataType: "text",
      success: function (response) {
        notificationItem[index].remove();
        console.log(response)
        let newNotification=document.querySelectorAll('.new-notification')
        notificationLength.innerHTML = `(${newNotification.length})`;
        showMessage("удаленно", "Удалено 1 уведомление", successful);
      }
    })
  };
});

deleteAllNotification.onclick=()=>{
  $.ajax({
    type: "post",
    url: "/ajax/notification/delete",
    data: ({"type":2,"token":$("#token").text()}),
    dataType: "text",
    success: function (response) {
      notificationItem.forEach((elem)=>{
        elem.remove();
      })

        notificationLength.innerHTML = `(0)`;
      console.log(response)
      showMessage("удаленно", "Удалены все уведомления", successful);
    }
  })
};

function updateNotification(elem, index) {
  if (!elem.parentNode.classList.contains('new-notification')) return
  $.ajax({
    type: "POST",
    url: "/ajax/notification/update",
    data: ({"token":$("#token").text(),"id_not":notificationItem[index].id}),
    dataType: "text",
    success: function (response) {
      console.log(response)
    }
  })
};
}