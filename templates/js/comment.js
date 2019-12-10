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
    height:'200',
    startupOutlineBlocks:true,
    startupFocus : false,
    scayt_autoStartup:true,
    toolbar: [
        { name: 'insert', items : [ 'HKemoji' ] }
    ]
}

CKEDITOR.replace('textComment', config2);

$("#sendComment").click(function (e) { 
    var text = CKEDITOR.instances['textComment'].getData();
    if (text.length<10){
        alert("сообщение похоже на спам")
        return
    }
    $('.form .disable').css('display','flex')
    CKEDITOR.instances['textComment'].setData('');
    CKEDITOR.instances['textComment'].setReadOnly(true);
    var id_post=document.location.pathname.split('/')
    id_post=id_post[id_post.length-1].split('-')[0]
    var new_comment=`<div class="video-comment-item" style="display:none"></div>`
    $(".video-comments").prepend(new_comment)
    $.ajax({
        type: "post",
        url: "/ajax/add/comment",
        data: ({"comment":{"token":$("#token").text(),"body":text,"id_post":id_post}}),
        dataType: "text",
        success: function (response) {

            res= JSON.parse(response);
            if (res.status == 403){
                alert('Авторизуйтесь пожалуйста');
                $('.form .disable').css('display','none')
                return false;
            }
                var commentToPut=`
                                        <div class="video-comment-user-avatar">
                                            <img src="${res.img}">
                                        </div>
                                        <div class="video-comment-right" style="${res.back_fon}">
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
                                    
                $('.form .disable').css('display','none')
                $('.video-comment-item:nth-child(1)').html(commentToPut)
                $('.video-comment-item:nth-child(1)').slideDown('slow')
                CKEDITOR.instances['textComment'].setReadOnly(false);
                // $(".video-comments").prepend(commentToPut)
        }
    });
});