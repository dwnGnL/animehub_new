let innerChat = document.querySelector('#chat');
let scrollToBottom = document.querySelector('.scroll-bottom')
let chat = document.querySelector('.chat-block');
let chatHeader = document.querySelector('.chat-header');
let showChat = document.querySelector('.show-chat');
let crossChat = document.querySelector('.cross-chat');
let controls = document.querySelector('.control-chat');
if(controls!==null){
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

editor.on('key', function(e) {
  if(e.data.keyCode == 13) {


    var mymessage = CKEDITOR.instances['redactor'].getData();
    if(mymessage == "") {
        showMessage("error","Введите ваше сообщение!", error);
        return;
    }
    sendMessage(mymessage);
    CKEDITOR.instances['redactor'].setData("");
  }
});

}
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
  if (document.body.clientWidth >= 767) {
      chat.style.top = window.pageYOffset + 50 + 'px';

      onConnect();
  }
  if (document.body.clientWidth < 767) document.body.style.overflow = 'hidden';
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

  chat.onmouseup = function() {
    document.removeEventListener('mousemove', onMouseMove);
    chat.onmouseup = null;
  };
};

chat.ondragstart = function() {
  return false;
};





$('#sendChat').click(function() {
                var mymessage = CKEDITOR.instances['redactor'].getData();
                if(mymessage == "") {
                    showMessage("error","Введите ваше сообщение!", error);
                    return;
                }
                sendMessage(mymessage);
                CKEDITOR.instances['redactor'].setData("");
});

function viewMessage(message) {
    if (message.messages.length == 1){
        template(message.messages.img, message.messages.login, message.messages.date, message.messages.text, message.messages.login_color, message.messages.font,message.messages.id_chat)
    }else {
        for (var i = 0; i < message.messages.length; i++) {
            template(message.messages[i].img, message.messages[i].login, message.messages[i].date, message.messages[i].text, message.messages[i].login_color, message.messages[i].font,message.messages[i].id_chat)
        }
    }
    localStorage.setItem('idInterval',setInterval(onListener, 500) );

}

function onConnect() {
    $.ajax({
        url: '/ajax/chat/connect',
        method: 'POST',
        data: ({token: $('#token').text()}),
        success: function (data) {
          var message = JSON.parse(data);
            viewMessage(message);
        }
    });

}

function onListener() {
    var lastMessage = $('.chat-user:last').attr('id');
    localStorage.setItem('id_chat', lastMessage);
    if (lastMessage !== 'undefined'){
        lastMessage = parseInt(lastMessage) + 1;
        console.log(lastMessage);
        $.ajax({
            url: '/ajax/chat/online',
            method: 'POST',
            data: ({token: $('#token').text(), id_message: lastMessage }),
            success: function (data) {
                var message = JSON.parse(data);
                if (message.messages.login){
                    template(message.messages.img, message.messages.login, message.messages.date, message.messages.text, message.messages.login_color, message.messages.font,message.messages.id_chat);
                }
            }
        })
    }

}

function sendMessage(message) {
    $.ajax({
        url: '/ajax/chat/message',
        method: 'POST',
        data: ({token: $('#token').text(), message: message }),
        success: function (data) {
            var message = JSON.parse(data);
        }
    })
}

function template(avatar, username, date, mess, color, font, id_chat)
{


    // var message=`<div class="chat-item" style="display:none">
    var message=`<div class="chat-item">
        <div class="chat-user" id="${id_chat}">
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

};