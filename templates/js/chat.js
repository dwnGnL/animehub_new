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

    function template(selector, selectorAll, textArray, object, color, font)
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
        template('#system_msg', "td", ['Вы подключены!'])            

    };

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
            template('#usersmsg', "span", [utime+' : ', uname+' : ', umsg], '.myName', msg.login_color, msg.font)
        }
    };

    websocket.onerror   = function(ev) {
        template('#system_msg', "td", ["Ошибка при подключении!"], 'td.system_msg', '#BDBDBD')
    };

    websocket.onclose   = function(ev) {
        template('#system_msg', "td", ["Подключение закрыто!"], 'td.system_msg', '#BDBDBD')
    };

});
