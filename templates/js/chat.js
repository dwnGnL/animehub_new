let chat = document.querySelector('.chat-block');
let chatHeader = document.querySelector('.chat-header');

let showChat = document.querySelector('.show-chat');
let crossChat = document.querySelector('.cross-chat');



showChat.onclick = () => {
  chat.style.transform = 'translateX(0)';
  chat.style.top = window.pageYOffset + 50 + 'px';
}

crossChat.onclick = () => {
  chat.style.transition = '.5s';
  chat.style.left = 0;
  setTimeout(() => {
    chat.style.transform = 'translateX(-350px)';
    chat.style.transition = 'transform .5s';
  }, 400);
};


chatHeader.onmousedown = event => {
  let shiftX = event.clientX - chat.getBoundingClientRect().left;
  let shiftY = event.clientY - chat.getBoundingClientRect().top;

  moveAt(event.pageX, event.pageY);

  function moveAt(pageX, pageY) {
    chat.style.left = pageX - shiftX + 'px';
    chat.style.top = pageY - shiftY + 'px';
  }

  function onMouseMove(event) {
    moveAt(event.pageX, event.pageY);
  }

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

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    var id_user = getCookie('id');
    websocket = new WebSocket("ws://127.0.0.1:8000");

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
    {
        var t = document.querySelector(selector);
        td = t.content.querySelectorAll(selectorAll);
        $(td[1]).attr('style', 'color:'+color);

        for (var i = 0; i < textArray.length; i++) {
            td[i].textContent = textArray[i];
        };

        var div = document.getElementById('message_box');
        var clone = t.content.cloneNode(true);
        div.appendChild(clone);
    };


    websocket.onopen = function(ev) {
        template('#system_msg', "td", ['Вы подключены!'])
            uniqueId = genarationString();
            userColor = genarationColor();
    }

    $('#send-btn').click(function() {
        var mymessage = $('#message').val();

        if(mymessage == "") {
            alert("Введите ваше сообщение!");
            return;
        }

        var msg = {
            message: mymessage,
            id_user: id_user
        };

        websocket.send(JSON.stringify(msg));
    });

/*
* При получении сообщения оно пишется или в сервисный блок, или в блок текущего пользователя,
* или в блок других пользователей
*/
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data);
        console.log(ev.data);
        var umsg = msg.message;
        var uname = msg.id_user;
        var utime = msg.time;
        console.log(umsg);
        if (msg.service) {
            template('#system_msg', "td", [msg.service], 'td.system_msg', '#BDBDBD')
            return;
        }

        if (msg.dialog) {
            for (var i = 0; i < msg.dialog.length; i++) {
                template('#usersmsg', "span", [msg.dialog[i].date+' : ', msg.dialog[i].login+' : ', msg.dialog[i].text], '.userName', msg.dialog[i].login_color)
            };
            return;
        }

        if(umsg) {
            template('#mymsg', "span", [utime+' : ', uname+' : ', umsg], '.myName', msg.userColor)
        } else {
            template('#usersmsg', "span", [utime+' : ', uname+' : ', umsg], '.userName', msg.userColor)
        }
    };

    websocket.onerror   = function(ev) {
        template('#system_msg', "td", ["Ошибка при подключении!"], 'td.system_msg', '#BDBDBD')
    };

    websocket.onclose   = function(ev) {
        template('#system_msg', "td", ["Подключение закрыто!"], 'td.system_msg', '#BDBDBD')
    };

});
