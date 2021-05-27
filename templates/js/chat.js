let innerChat = document.querySelector('#chat');
let scrollToBottom = document.querySelector('.scroll-bottom')
let chat = document.querySelector('.chat-block');
let chatHeader = document.querySelector('.chat-header');
let showChat = document.querySelector('.show-chat');
let crossChat = document.querySelector('.cross-chat');
let controls = document.querySelector('.control-chat');

if (controls !== null) {
  var config2 = {
    height: '69',
    width: '300',
    toolbarStartupExpanded: false,
    contentsCss: 'body{background:#f8f8f8;}',
    enterMode: CKEDITOR.ENTER_BR,
    toolbar: [],
    enterMode: () => alert("dsds")
  };

  editor = CKEDITOR.replace('redactor', config2);

  editor.on('key', function (e) {
    if (e.data.keyCode == 13) {


      var mymessage = CKEDITOR.instances['redactor'].getData();


      if (mymessage == "") {
        showMessage("error", "Введите ваше сообщение!", error);
        return;
      }
      sendMessage(mymessage);
      CKEDITOR.instances['redactor'].setData("");
    }
  });

}
var page = 1;
innerChat.onscroll = () => {
  let scrollBottom = innerChat.scrollHeight - innerChat.scrollTop - innerChat.clientHeight;
  if (innerChat.scrollTop == 0){


      onMessagesScroll(page, innerChat.scrollHeight);
    page++;

  }

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
$(document).ready(function () {
  localStorage.removeItem('click');

  $.ajax({
    type: "post",
    url: "/ajax/check/auth",
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 401) {
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
        if (user.status == 200) {
          // Если чел авторизован и все успешно, его инфа в локал сохраняем
          localStorage.setItem('user', JSON.stringify(user.info));

        } else {
          // если юзер не авторизован тут выводи какиую нибудь ошибку, чтоб авторизовался для того что бы пользоваться чатом

          localStorage.removeItem('user');
        }

      }
    });
  }
});


showChat.onclick = () => {
  chat.style.transform = 'translateX(0)';
  if (document.body.clientWidth >= 767) {
    chat.style.top = window.pageYOffset + 50 + 'px';
  }

  if (document.body.clientWidth < 767) document.body.style.overflow = 'hidden';
  if (localStorage.getItem('click') === null) {
    onConnect(0);
    localStorage.setItem('click', 1);
  } else {
    onMessage();
  }
};

crossChat.onclick = () => {
  clearInterval(localStorage.getItem('idInterval'));
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

  chat.onmouseup = function () {
    document.removeEventListener('mousemove', onMouseMove);
    chat.onmouseup = null;
  };
};

chat.ondragstart = function () {
  return false;
};

$('#sendChat').click(function () {
  var mymessage = CKEDITOR.instances['redactor'].getData();

  if (mymessage == "") {
    showMessage("error", "Введите ваше сообщение!", error);
    return;
  }

  sendMessage(mymessage);
  CKEDITOR.instances['redactor'].setData("");
});

function isLaravel(str){
  if (str.indexOf('storage/uploads/avatars') !== -1){
      return true;
  }
  return  false;
}

function viewAvatar(str){
  if (isLaravel(str)){
    return `${BASE_URL}/${str}`
  }
  return str;
}


function viewMessage(message) {
  if (message.messages.length == 1) {
    template(viewAvatar(message.messages.img), message.messages.login, message.messages.date, message.messages.text, message.messages.login_color, message.messages.font, message.messages.id_chat, message.messages.status, message.messages.color)
  } else {
    for (var i = message.messages.length - 1; i >= 0 ; i--) {
      template(message.messages[i].img, message.messages[i].login, message.messages[i].date, message.messages[i].text, message.messages[i].login_color, message.messages[i].font, message.messages[i].id_chat, message.messages[i].status, message.messages[i].color)
    }
  }
  localStorage.setItem('idInterval', setInterval(onListener, 500));

}

function viewMessageAjax(message) {
  if (message.messages.length == 1) {
    ajaxView(viewAvatar(message.messages.img), message.messages.login, message.messages.date, message.messages.text, message.messages.login_color, message.messages.font, message.messages.id_chat, message.messages.status, message.messages.color)
  } else {
    for (var i = 0; i < message.messages.length; i++) {
      ajaxView(viewAvatar(message.messages[i].img), message.messages[i].login, message.messages[i].date, message.messages[i].text, message.messages[i].login_color, message.messages[i].font, message.messages[i].id_chat, message.messages[i].status, message.messages[i].color)
    }
  }
  localStorage.setItem('idInterval', setInterval(onListener, 500));

}
function onConnect(page) {
  $("#chat .disable").toggle();
  $.ajax({
    url: '/ajax/chat/connect',
    method: 'POST',
    data: ({ token: $('#token').text(), 'page': page }),
    success: function (data) {
      var message = JSON.parse(data);
      viewMessage(message);
      $("#chat .disable").toggle()

    }
  });

}

function onMessagesScroll(page, oldHeight) {
  $("#chat .disable").toggle();
  $.ajax({
    url: '/ajax/chat/connect',
    method: 'POST',
    data: ({ token: $('#token').text(), 'page': page }),
    success: function (data) {
      var message = JSON.parse(data);
      viewMessageAjax(message);
      $("#chat .disable").toggle();
      innerChat.scrollTo(0, innerChat.scrollHeight - oldHeight)
    }
  });

}

function onListener() {
  var lastMessage = $('.chat-user:last').attr('id');
  localStorage.setItem('id_chat', lastMessage);
  if (lastMessage !== 'undefined') {
    lastMessage = parseInt(lastMessage) + 1;
    $.ajax({
      url: '/ajax/chat/online',
      method: 'POST',
      data: ({ token: $('#token').text(), id_message: lastMessage }),
      success: function (data) {
        var message = JSON.parse(data);
        if (message.messages) {
          template(message.messages.img, message.messages.login, message.messages.date, message.messages.text, message.messages.login_color, message.messages.font, message.messages.id_chat, message.messages.status, message.messages.color);
        }
      }
    })
  }

}

function onMessage() {
  var lastMessage = $('.chat-user:last').attr('id');
  if (lastMessage !== 'undefined') {
    $.ajax({
      url: '/ajax/chat/getMessage',
      method: 'POST',
      data: ({ id_chat: lastMessage }),
      success: function (data) {
        var message = JSON.parse(data);
        viewMessage(message);
      }
    })
  }

}
function sendMessage(message) {
  $.ajax({
    url: '/ajax/chat/message',
    method: 'POST',
    data: ({ token: $('#token').text(), message: message }),
    success: function (data) {
      var message = JSON.parse(data);
    }
  })
}

function template(avatar, username, date, mess, color, font, id_chat, status, status_color) {


  // var message=`<div class="chat-item" style="display:none">
  var message = `<div class="chat-item">
        <div class="chat-user" id="${id_chat}">
          <div class="chat-user-avatar"><img src="${viewAvatar(avatar)}"></div>
          <div class="chat-user-right">
            <div class="chat-user-name"><a style="${color};font-family:'${font}'" href="/profile/${username}">${username}</a> <span style="color: ${status_color}">${status}</span></div>
            <div class="chat-date">${date}</div>
          </div>
        </div>

        <div class="chat-text">${mess}</div>
      </div>`

  $("#chat").append(message);

  if (localStorage.getItem('user') !== null) {
    var parse = JSON.parse(localStorage.getItem('user'))
    if (username == parse.login) {
      avatar = parse.img
    }
    if (username == parse.login) {
      $('#chat .chat-item:last-child').addClass("chat-item-self")
    }

    scrollingToBottom()

  }

};

function ajaxView(avatar, username, date, mess, color, font, id_chat, status, status_color) {


  // var message=`<div class="chat-item" style="display:none">
  var message = `<div class="chat-item">
        <div class="chat-user" id="${id_chat}">
          <div class="chat-user-avatar"><img src="${avatar}"></div>
          <div class="chat-user-right">
            <div class="chat-user-name"><a style="${color};font-family:'${font}'" href="/profile/${username}">${username}</a> <span style="color: ${status_color}">${status}</span></div>
            <div class="chat-date">${date}</div>
          </div>
        </div>

        <div class="chat-text">${mess}</div>
      </div>`

  $("#chat").prepend(message);

  if (localStorage.getItem('user') !== null) {
    var parse = JSON.parse(localStorage.getItem('user'))
    if (username == parse.login) {
      avatar = parse.img
    }
    if (username == parse.login) {
      $('#chat .chat-item:last-child').addClass("chat-item-self")
    }


  }

};
