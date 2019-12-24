let chat = document.querySelector('.chat-block');
let chatHeader = document.querySelector('.chat-header');
let showChat = document.querySelector('.show-chat');
let crossChat = document.querySelector('.cross-chat');


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

<<<<<<< HEAD
    function template(selector, selectorAll, textArray, object, color, font)
=======
/*
* В genarationString генерируется уникальная строка, которая будет идентификатором пользователя
*
*/
    function genarationString()
    {
        var rnd = '';
        while (rnd.length < 10)
            rnd += Math.random().toString(36).substring(2);
        uniqueId = rnd.substring(0, 10);
        return uniqueId;
    };

/*
* В genarationColor выбирается цвет для пользователя рандомным образом
*
*/
    function genarationColor()
    {
        var arr = ['red', 'black', 'orange', 'pink'];
        var rand = Math.floor(Math.random() * arr.length);
        return arr[rand];
    };

    function template(selector, selectorAll, textArray, object, color)
>>>>>>> a88a13b89a40af8ad8a549b250089af8ffe3c1eb
    {
        var t = document.querySelector(selector);
        td = t.content.querySelectorAll(selectorAll);
        $(td[1]).attr('style', color + '; font-family:' + font);


        for (var i = 0; i < textArray.length; i++) {
            td[i].textContent = textArray[i];
        };

        var div = document.getElementById('message_box');
        var clone = t.content.cloneNode(true);
        div.appendChild(clone);
    };


    websocket.onopen = function(ev) {
<<<<<<< HEAD
        template('#system_msg', "td", ['Вы подключены!'])            

    };
=======
        template('#system_msg', "td", ['Вы подключены!'])
            uniqueId = genarationString();
            userColor = genarationColor();
    }
>>>>>>> a88a13b89a40af8ad8a549b250089af8ffe3c1eb

    $('#send-btn').click(function() {

                var user = JSON.parse(localStorage.getItem('user'));

                var mymessage = $('#message').val();
                if(mymessage == "") {
                    alert("Введите ваше сообщение!");
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

        var umsg = msg.message;
        var uname = msg.login;
        var utime = msg.time;

        if (msg.service) {
            template('#system_msg', "td", [msg.service], 'td.system_msg', '#BDBDBD');
            return;
        }

        if (msg.dialog) {
            for (var i = 0; i < msg.dialog.length; i++) {
                template('#usersmsg', "span", [msg.dialog[i].date.substring(11)+' : ', msg.dialog[i].login+' : ', msg.dialog[i].text], '.userName', msg.dialog[i].login_color, msg.dialog[i].font)
            };
            return;
        }

        if(umsg) {
<<<<<<< HEAD
            template('#usersmsg', "span", [utime+' : ', uname+' : ', umsg], '.myName', msg.login_color, msg.font)
=======
            template('#mymsg', "span", [utime+' : ', uname+' : ', umsg], '.myName', msg.userColor)
        } else {
            template('#usersmsg', "span", [utime+' : ', uname+' : ', umsg], '.userName', msg.userColor)
>>>>>>> a88a13b89a40af8ad8a549b250089af8ffe3c1eb
        }
    };

    websocket.onerror   = function(ev) {
        template('#system_msg', "td", ["Ошибка при подключении!"], 'td.system_msg', '#BDBDBD')
    };

    websocket.onclose   = function(ev) {
        template('#system_msg', "td", ["Подключение закрыто!"], 'td.system_msg', '#BDBDBD')
    };

});
