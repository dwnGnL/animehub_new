let innerChat = document.querySelector('#chat');
let scrollToBottom = document.querySelector('.scroll-bottom')
let chat = document.querySelector('.chat-block');
let chatHeader = document.querySelector('.chat-header');
let showChat = document.querySelector('.show-chat');
let crossChat = document.querySelector('.cross-chat');

var config2 = {
    height:'69',
    width:'300',
    toolbarStartupExpanded : false,
    contentsCss : 'body{background:#f8f8f8;}',
    enterMode : CKEDITOR.ENTER_BR,
    toolbar: [],
    enterMode: ()=>alert("dsds")
  };

  editor=CKEDITOR.replace('redactor', config2);
// 
editor.on('key', function(e) {
  if(e.data.keyCode == 13) {
    var user = JSON.parse(localStorage.getItem('user'));

    var mymessage = CKEDITOR.instances['redactor'].getData();;
    if(mymessage == "") {
        showMessage("error","Введите ваше сообщение!", error);
        return;
    }

    var msg = {
        img: user.img,
        message: mymessage,
        id_user: user.id,
        login: user.login,
        login_color: user.login_color,
        font: user.font
    };

    websocket.send(JSON.stringify(msg));
    CKEDITOR.instances['redactor'].setData("");
  }
});


innerChat.onscroll = () => {
  let scrollBottom = innerChat.scrollHeight - innerChat.scrollTop - innerChat.clientHeight;


  if (scrollBottom > 1000) {
    if (scrollToBottom.classList.contains('show-scroll-bottom')) return;
    scrollToBottom.style.display = 'block';
    setTimeout(() => scrollToBottom.classList.add('show-scroll-bottom'), 10);
  } else {
    if (scrollToBottom.classList.contains('show-scroll-bottom')) {
      scrollToBottom.classList.remove('show-scroll-bottom');
      setTimeout(() => scrollToBottom.style.display = 'none', 300);
    };
  };
};

scrollToBottom.onclick = scrollingToBottom;


function scrollingToBottom() {
  innerChat.scrollTo(0, innerChat.scrollHeight);
};







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


// ----------------------------------

$(document).ready(function(){
    $.ajax({
        type: "post",
        url: "/ajax/check/auth",
        success: function (response) {
            response = JSON.parse(response);
            if(response.status==501){
                localStorage.removeItem("user")
            }
        }
    });

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

                localStorage.removeItem('user');
            }

            }
        });
    }
    // Создаем экземпляр класса вебсокет
    websocket = new WebSocket("ws://127.0.0.1:8000");



    function template(avatar, username, date, mess, color, font)
    {


      // var message=`<div class="chat-item" style="display:none">
        var message=`<div class="chat-item">
        <div class="chat-user">
          <div class="chat-user-avatar"><img src="${avatar}"></div>
          <div class="chat-user-right">
            <div class="chat-user-name" style="${color};font-family:'${font}'">${username}</div>
            <div class="chat-date">${date}</div>
          </div>
        </div>

        <div class="chat-text">${mess}</div>
      </div>`

      $("#chat").append(message);

        if (localStorage.getItem('user') !== null) {
            var parse=JSON.parse(localStorage.getItem('user'))
            if (username==parse.login){
                avatar=parse.img
            }
            if (username==parse.login){
                $('#chat .chat-item:last-child').addClass("chat-item-self")
            }
            if (username==parse.login) scrollingToBottom()
        }

      // $('#chat .chat-item:last-child').toggle('slow')


    };


    websocket.onopen = function(ev) {

    };

    $('#sendChat').click(function() {

                var user = JSON.parse(localStorage.getItem('user'));

                var mymessage = CKEDITOR.instances['redactor'].getData();
                if(mymessage == "") {
                    showMessage("error","Введите ваше сообщение!", error);
                    return;
                }

                var msg = {
                    img: user.img,
                    message: mymessage,
                    id_user: user.id,
                    login: user.login,
                    login_color: user.login_color,
                    font: user.font
                };
                console.log(msg);
                websocket.send(JSON.stringify(msg));
                CKEDITOR.instances['redactor'].setData("");
            });

/*
* При получении сообщения оно пишется или в сервисный блок, или в блок текущего пользователя,
* или в блок других пользователей
*/
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data);

        var umsg = msg.message;
        var uname = msg.login;
        var utime = msg.time;

        template(msg.img, uname, utime,umsg,msg.login_color,msg.font);
   
        if (msg.dialog) {
          for (var i = 0; i < msg.dialog.length; i++) {
            template(msg.dialog[i].img, msg.dialog[i].login, msg.dialog[i].date, msg.dialog[i].text, msg.dialog[i].login_color, msg.dialog[i].font)
          };
          return;
        }
    };

    websocket.onerror   = function(ev) {
      var errorMes=`<hr><p>Ошибка подключения</p><hr>`;
      $("#chat").append(errorMes)
    };

    websocket.onclose   = function(ev) {
      var errorMes=`<hr><p>Соединение выключенно</p><hr>`;
      $("#chat").append(errorMes)

    };


});
