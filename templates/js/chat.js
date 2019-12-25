let chat = document.querySelector('.chat-block');
let chatHeader = document.querySelector('.chat-header');
let showChat = document.querySelector('.show-chat');
let crossChat = document.querySelector('.cross-chat');

var config2 = {
  height:'69',
  width:'300',
  toolbarStartupExpanded : false,
  contentsCss : 'body{background:#f8f8f8;}',
  toolbar: [],
  enterMode: ()=>alert("dsds")
}

CKEDITOR.replace('redactor', config2);

showChat.onclick = () => {
  chat.style.transform = 'translateX(0)';
  if (document.body.clientWidth >= 767) chat.style.top = window.pageYOffset + 50 + 'px';
  if (document.body.clientWidth < 767) document.body.style.overflow = 'hidden';
};

crossChat.onclick = () => {
  chat.style.transition = '.5s';
  chat.style.left = 0;
  setTimeout(() => {
    chat.style.transform = `translateX(-${chat.clientWidth + 15}px)`;
    chat.style.transition = 'transform .5s';
  }, 400);
  document.body.style.overflow = 'auto';
};

chatHeader.onmousedown = event => {
  if (document.body.clientWidth < 767) return;

  let shiftX = event.clientX - chat.getBoundingClientRect().left;
  let shiftY = event.clientY - chat.getBoundingClientRect().top;

  moveAt(event.pageX, event.pageY);

  function moveAt(pageX, pageY) {
    chat.style.left = pageX - shiftX + 'px';
    chat.style.top = pageY - shiftY + 'px';
  };

  function onMouseMove(event) {
    moveAt(event.pageX, event.pageY);
  };

  document.addEventListener('mousemove', onMouseMove);

  chat.onmouseup = function() {
    document.removeEventListener('mousemove', onMouseMove);
    chat.onmouseup = null;
  };
};

chat.ondragstart = function() {
  return false;
};

window.onkeydown = (event) => {
  if (event.ctrlKey && event.code == 'Enter') {
    alert('done');
  };
};

// ----------------------------------

$(document).ready(function(){

    // Тут с базы в локал сторейг берет данные о юзере
    if (localStorage.getItem('user') === null) {
        $.ajax({
            url: '/ws/login',
            method: 'GET',
            success: function (data) {
                var user = JSON.parse(data);
            if (user.status == 200){
                // Если чел авторизован и все успешно, его инфа в локал сохраняем
                localStorage.setItem('user', JSON.stringify(user.info));

            }else {
                // если юзер не авторизован тут выводи какиую нибудь ошибку, чтоб авторизовался для того что бы пользоваться чатом

                localStorage.clear();
            }

            }
        });
    }
    // Создаем экземпляр класса вебсокет
    websocket = new WebSocket("ws://127.0.0.1:8000");

    function template(avatar, username, date, mess, color, font)
    {
        var message=`<div class="chat-item" style="display:none">
        <div class="chat-user">
          <div class="chat-user-avatar"><img src="${avatar}"></div>
          <div class="chat-user-right">
            <div class="chat-user-name" style="color:'${color}';font-family:'${font}'">${username}</div>
            <div class="chat-date">${date}</div>
          </div>
        </div>

        <div class="chat-text">${mess}</div>
      </div>`

      $("#chat").append(message)
      $('#chat .chat-item:last-child').slideDown('slow')
    };


    websocket.onopen = function(ev) {
        template('/templates/images/avatar/1.png', "ngnl", "dsds","hello","red","")
    };

    $('#sendChat').click(function() {

                var user = JSON.parse(localStorage.getItem('user'));

                var mymessage = CKEDITOR.instances['redactor'].getData();;
                if(mymessage == "") {
                    showMessage("error","Введите ваше сообщение!",error);
                    return;
                }

                var msg = {
                    message: mymessage,
                    id_user: user.id,
                    login: user.login,
                    login_color: user.login_color,
                    font: user.font
                };

                websocket.send(JSON.stringify(msg));

            });





/*
* При получении сообщения оно пишется или в сервисный блок, или в блок текущего пользователя,
* или в блок других пользователей
*/
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data);
        template('/templates/images/avatar/1.png', "ngnl", "dsds","hello","red","")

        var umsg = msg.message;
        var uname = msg.login;
        var utime = msg.time;


    };

    websocket.onerror   = function(ev) {
        template('#chat', "td", ["Ошибка при подключении!"], 'td.system_msg', '#BDBDBD')
    };

    websocket.onclose   = function(ev) {
        template('#chat', "td", ["Подключение закрыто!"], 'td.system_msg', '#BDBDBD')
    };

});
