let otvet = document.querySelectorAll("div.answer-comment")

// var config1 = {
//   height:'200',
//   startupOutlineBlocks:true,
//   scayt_autoStartup:true,
//   toolbar:[
//
//     { name: 'insert', items : [ 'Smiley' ] }
//   ]
// }
// CKEDITOR.replace('textComment',config1);

var config2 = {
  height: '200',
  startupOutlineBlocks: true,
  startupFocus: false,
  scayt_autoStartup: true,
  toolbar: [
    { name: 'insert', items: ['HKemoji'] }
  ]
}

CKEDITOR.replace('textComment', config2);

$("#sendComment").click(function (e) {
  var mymessage = CKEDITOR.instances['textComment'].getData();
  var regex="/[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}"
  var links=mymessage.match(regex)
  console.log(mymessage)
  console.log(links)

  if(links){
    console.log("этап 1")

    links.forEach(element => {
      element=element.substr(1)
      console.log(element)
      if (element=="animehub.tj"||element=="/animehub.tj") return
      let fulllink="http://"+element
      let fulllinks="https://"+element
      let hreflinks='href="'+element
      let hreflinks2="href='"+element
      let srclinks='src="'+element
      let srclinks2="src='"+element
      
      if(mymessage.indexOf(fulllink)+1>=0 
      || mymessage.indexOf(fulllinks)+1>=0 
      || mymessage.indexOf(hreflinks)+1>=0 
      || mymessage.indexOf(hreflinks2)+1>=0 
      || mymessage.indexOf(srclinks)+1>=0 
      || mymessage.indexOf(srclinks2)+1>=0
      || mymessage.indexOf("<object")
      || mymessage.indexOf("<script")){
        mymessage=""
      }
    });
  }
  mymessage=mymessage.replace("<br />","")
  mymessage=mymessage.replace("<h1>","")
  mymessage=mymessage.replace("</h1>","")
  mymessage=mymessage.replace("<h2>","")
  mymessage=mymessage.replace("</h2>","")
  mymessage=mymessage.replace("<h3>","")
  mymessage=mymessage.replace("</h3>","")
  mymessage=mymessage.replace("<h4>","")
  mymessage=mymessage.replace("</h4>","")
  mymessage=mymessage.replace("<h5>","")
  mymessage=mymessage.replace("</h5>","")
  mymessage=mymessage.replace("style=","")
  mymessage=mymessage.replace("<i>","")
  mymessage=mymessage.replace("</i>","")
  if (mymessage.length < 10) {
    alert("сообщение похоже на спам")
    return
  }
  $('.form .disable').css('display', 'flex')
  CKEDITOR.instances['textComment'].setData('');
  CKEDITOR.instances['textComment'].setReadOnly(true);
  var id_post = document.location.pathname.split('/')
  id_post = id_post[id_post.length - 1].split('-')[0]
  var new_comment = `<div class="video-comment-item" style="display:none"></div>`
  $(".video-comments").prepend(new_comment)
  $.ajax({
    type: "post",
    url: "/ajax/add/comment",
    data: ({ "comment": {  "body": mymessage, "id_post": id_post }, "token": $("#token").text() }),
    dataType: "text",
    success: function (response) {
      res = JSON.parse(response);
      if (res.status == 403) {
        showMessage("Ошибка", 'Авторизуйтесь пожалуйста', "error-message")
        alert('Авторизуйтесь пожалуйста');
        $('.form .disable').css('display', 'none')
        return false;
      }

      if (res.back_fon != "") {
        var commentToPut = `
        <div class="video-comment-user-avatar">
          <img src="${res.img}">
        </div>
        <div class="video-comment-right vip" style='background-image:${res.back_fon}'>
        <div class="comment-arrow"></div>
        <div class="top-video-comment-item">
          <div class="video-comment-user-name" style="font-family:${res.font}; ${res.login_color}">
            ${res.login} <span style="color:${res.color}">${res.status}</span>
          </div>
          <div class="video-comment-date">
            ${res.date}
          </div>
        </div>
        <div class="video-comment-text">
          ${res.body}
          <div class="answer-comment"><i class="fa fa-reply"></i></div>
        </div>
        ${res.vip_status}
      </div>
      `
      } else {
        var commentToPut = `
          <div class="video-comment-user-avatar">
            <img src="${res.img}">
          </div>
          <div class="video-comment-right">
          <div class="comment-arrow"></div>
          <div class="top-video-comment-item">
            <div class="video-comment-user-name" style="font-family:${res.font}; ${res.login_color}">
              ${res.login} <span style="color:${res.color}">${res.status}</span>
            </div>
            <div class="video-comment-date">
              ${res.date}
            </div>
          </div>
          <div class="video-comment-text">
            ${res.body}
          </div>
        </div>
        `
      }


      $('.form .disable').css('display', 'none')
      $('.video-comment-item:nth-child(1)').html(commentToPut)
      $('.video-comment-item:nth-child(1)').slideDown('slow')
      CKEDITOR.instances['textComment'].setReadOnly(false);
      // $(".video-comments").prepend(commentToPut)
    }
  });
});

$("#sendComment2").click(function (e) {
  var mymessage = $("#textarea").val()
  var regex="/[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}"
  var links=mymessage.match(regex)
  console.log(mymessage)
  console.log(links)

  if(links){
    console.log("этап 1")

    links.forEach(element => {
      element=element.substr(1)
      console.log(element)
      if (element=="animehub.tj"||element=="/animehub.tj") return
      let fulllink="http://"+element
      let fulllinks="https://"+element
      let hreflinks='href="'+element
      let hreflinks2="href='"+element
      let srclinks='src="'+element
      let srclinks2="src='"+element
      
      if(mymessage.indexOf(fulllink)+1>=0 
      || mymessage.indexOf(fulllinks)+1>=0 
      || mymessage.indexOf(hreflinks)+1>=0 
      || mymessage.indexOf(hreflinks2)+1>=0 
      || mymessage.indexOf(srclinks)+1>=0 
      || mymessage.indexOf(srclinks2)+1>=0
      || mymessage.indexOf("<object")
      || mymessage.indexOf("<script")){
        mymessage=""
      }
    });
  }
  mymessage=mymessage.replace("<br />","")
  mymessage=mymessage.replace("<h1>","")
  mymessage=mymessage.replace("</h1>","")
  mymessage=mymessage.replace("<h2>","")
  mymessage=mymessage.replace("</h2>","")
  mymessage=mymessage.replace("<h3>","")
  mymessage=mymessage.replace("</h3>","")
  mymessage=mymessage.replace("<h4>","")
  mymessage=mymessage.replace("</h4>","")
  mymessage=mymessage.replace("<h5>","")
  mymessage=mymessage.replace("</h5>","")
  mymessage=mymessage.replace("style=","")
  mymessage=mymessage.replace("<i>","")
  mymessage=mymessage.replace("</i>","")
  if (mymessage.length < 10) {
    alert("сообщение похоже на спам")
    return
  }
  $('.form .disable').css('display', 'flex')
  var id_post = document.location.pathname.split('/')
  id_post = id_post[id_post.length - 1].split('-')[0]
  var new_comment = `<div class="video-comment-item" style="display:none"></div>`
  $(".video-comments").prepend(new_comment)
  $.ajax({
    type: "post",
    url: "/ajax/add/comment",
    data: ({ "comment": {  "body": mymessage, "id_post": id_post }, "token": $("#token").text() }),
    dataType: "text",
    success: function (response) {
      res = JSON.parse(response);
      if (res.status == 403) {
        showMessage("Ошибка", 'Авторизуйтесь пожалуйста', "error-message")
        alert('Авторизуйтесь пожалуйста');
        $('.form .disable').css('display', 'none')
        return false;
      }

      if (res.back_fon != "") {
        var commentToPut = `
        <div class="video-comment-user-avatar">
          <img src="${res.img}">
        </div>
        <div class="video-comment-right vip" style='background-image:${res.back_fon}'>
        <div class="comment-arrow"></div>
        <div class="top-video-comment-item">
          <div class="video-comment-user-name" style="font-family:${res.font}; ${res.login_color}">
            ${res.login} <span style="color:${res.color}">${res.status}</span>
          </div>
          <div class="video-comment-date">
            ${res.date}
          </div>
        </div>
        <div class="video-comment-text">
          ${res.body}
          <div class="answer-comment"><i class="fa fa-reply"></i></div>
        </div>
        ${res.vip_status}
      </div>
      `
      } else {
        var commentToPut = `
          <div class="video-comment-user-avatar">
            <img src="${res.img}">
          </div>
          <div class="video-comment-right">
          <div class="comment-arrow"></div>
          <div class="top-video-comment-item">
            <div class="video-comment-user-name" style="font-family:${res.font}; ${res.login_color}">
              ${res.login} <span style="color:${res.color}">${res.status}</span>
            </div>
            <div class="video-comment-date">
              ${res.date}
            </div>
          </div>
          <div class="video-comment-text">
            ${res.body}
          </div>
        </div>
        `
      }


      $('.form .disable').css('display', 'none')
      $('.video-comment-item:nth-child(1)').html(commentToPut)
      $('.video-comment-item:nth-child(1)').slideDown('slow')
      CKEDITOR.instances['textComment'].setReadOnly(false);
      // $(".video-comments").prepend(commentToPut)
    }
  });
});
otvet.forEach((elem, index) => {
  elem.onclick = () => {
    var nickname = otvet[index].parentNode.parentNode
    nickname = nickname.querySelector(".video-comment-user-name a").textContent// $(this).closest('.video-comment-right').find('.video-comment-user-name').text();
    CKEDITOR.instances['textComment'].setData("<strong>" + nickname + "</strong>,");
    $(document).ready(function () {
      var destination = $("#cke_textComment").offset().top;
      $('html').animate({ scrollTop: destination }, 500);
    });
  }
});
