$("#send").on("click", function () {
    var count = $.trim($('#titleAnime').val());
    if( count.length > 3) {
        $('#titleAnime').removeClass('border-warning')
    $.ajax({
        url: 'lib/request.php',
        type: "POST",
        dataType: "text",
        data: ({send: $("#titleAnime").val(), startPage: $('#startPage').val(), endPage: $('#endPage').val(), startVideo: $('#startVideo').val(), endVideo: $('#endVideo').val(), site: $('select[name="site"]').val() }),
        beforeSend: funcBefore,
        success: funcSucces
    })
        $('#titleAnime').val('');
    }else {
        $('#titleAnime').addClass('border-warning')
    }
});

function funcBefore() {
    $("#load").removeClass("invisible");
}

function funcSucces(data)
{
    $("#load").addClass("invisible");
    $("#otvet").html(data);
}







$("#postSave").click(function () {
    $.ajax({
        url: 'lib/request.php',
        type: "POST",
        dataType: "text",
        data: $('#postForm').serialize(),
        success: success
    });

    console.log($('#postForm').serialize());
    $('#postTitle').val('');
    $('#postGodWip').val('');
    $('#postImg').val('');
    $('#postJanr').val('');
    $('#postOpisanie').val('');
    $('#postTv').val('');
    $('#idPostEdit').val('');
    $('#postPrichina').val('');
    $('#postType').val('');

});

function success(data){
    alert(data)
}

$("#searchChannel").on("click", function () {
    var count = $.trim($('#titleAnimeChannel').val());
    if( count.length > 3) {
        $('#titleAnimeChannel').removeClass('border-warning')
        $.ajax({
            url: 'lib/request.php',
            type: "POST",
            dataType: "text",
            data: ({titnleAnimeChannel: $("#titleAnimeChannel").val(), channel: $('select[name="Users"]').val(), pageStart: $('#startPageCh').val(), pageEnd: $('#endPageCh').val(), videoStart: $('#startVideoCh').val(), videoEnd: $('#endVideoCh').val() }),
            beforeSend: funcBeforeChannel,
            success: funcSuccesChannel
        });
        $('#titleAnimeChannel').val('');
    }else {
        $('#titleAnimeChannel').addClass('border-warning')
    }
});

function funcBeforeChannel() {
    $("#loadChannel").removeClass("invisible");
}

function funcSuccesChannel(data)
{
    alert(data);
    $("#loadChannel").addClass("invisible");
    $("#otvetChannel").html(data);
}



$('#sendUved').click(function () {
    var titleUveds = $('#titleUved').val();
    var textUveds = $('#textUved').val();
    var usersUveds = $('select[name="usersUved"]').val()
    $.ajax({
        url: 'lib/comment.php',
        type: 'POST',
        dataType: 'text',
        data: ({titleUved: titleUveds, textUved: textUveds, usersUved: usersUveds}),
        success: function (data) {
            
        }
    })
});

$('#tech').click(function () {
   $.ajax({
       url: 'lib/request.php',
       type: 'POST',
       dataType: 'text',
       data: ({tech: $('#tech').attr('id-text')}),
       success: function (data) {
           if(data == 1){

               $('#tech').text('Выключить тех...');
               $('#tech').attr('id-text', 0);
           }else {

               $('#tech').text('Включить тех...');
               $('#tech').attr('id-text',1);
           }
       }
   })
});


$('#sendText').click(function () {
    $('#message').removeClass('bg-danger');
    var message = $('#message').val();
    $('#message').val('');
    if(message.length > 0) {
        $.ajax({
            url: 'lib/ajax_php.php',
            type: 'POST',
            dataType: 'text',
            data: ({get: 'getMe'}),
            success: function (data) {
                var user = JSON.parse(data);
                $.ajax({
                    url: 'lib/send.php',
                    type: 'POST',
                    timeout: 10000,
                    dataType: 'text',
                    data: ({send: user['id'], text: message}),
                    success: function (data) {
                        $('#message').val('');

                    },
                    error: function () {

                    }
                })
            }
        });
    }else {
        $('#message').addClass('bg-danger');
    }

});

// функция вывода сообщений из базы
function showMessage() {
    $.ajax({
        url: 'lib/show.php',
        timeout: 10000,
        before: function (){
            $('#animation').removeClass('disb');
        },
        success: function (data) {
            $('#animation').addClass('disb');
            $('.conversation_inner').html(data);

        },
        error: function () {
            $('.conversation_inner').html('Не удалось загрузить сообщения!');
        }
    })
}

//
$('#chat .header').click(function () {

    var chat = localStorage.getItem('chat');

    if (chat == null || chat == 0){
        // тут функция вывода сообщений работает и запускается проверка на новые сообщении
        showMessage();
        var id_int = setInterval(getMessage, 1000);
        localStorage.setItem('id_int', id_int);
        localStorage.setItem('chat', '1');
    }else {
        clearInterval(localStorage.getItem('id_int'));
        localStorage.setItem('chat', '0');
    }

// функция которая грузит новые сообщении по 1 штуке
function getMessage(){
        var id = $(".my_msg").first().attr( "id-msg" );
        $.ajax({
            url: 'lib/chat.php',
            method: 'post',
            dataType: 'text',
            data: ({id_chat: id }),
            success: function (data) {
                $('.conversation_inner').prepend(data);
            }
        })
}


});
$('Document').ready(function () {
    localStorage.clear();
});

$('#textarea').keypress(function (e) {
    var enter = e.which;
    var message = $('#message').val();

    if(enter == 13){
        $('#message').removeClass('bg-danger');
        $('#message').val('');
        if(message.length > 0) {
            $.ajax({
                url: 'lib/ajax_php.php',
                type: 'POST',
                dataType: 'text',
                data: ({get: 'getMe'}),
                success: function (data) {
                    var user = JSON.parse(data);
                    $.ajax({
                        url: 'lib/send.php',
                        type: 'POST',
                        timeout: 10000,
                        dataType: 'text',
                        data: ({send: user['id'], text: message}),
                        success: function (data) {
                            $('#message').val('');

                        },
                        error: function () {

                        }
                    })
                }
            });
        }else {
            $('#message').addClass('bg-danger');
        }
    }
});

$('document').ready(function () {
    $.ajax({
        url: 'lib/comment.php',
        method: 'POST',
        dataType: 'text',
        data: ({getCountUved: 'Get'}),
        success: function (data) {
            if(data > 0){
                $('#uvedInfo').html('У вас' + data + 'не прочитанных уведомлений');
                $('.toast').toast('show');
            }
        }
    })
});

$('#uvedInfo').click(function () {
    $('.toast').toast('hide');
});

// аякс поиск

$('#animeTitle').bind("change keyup input click", function() {

    if ($('#animeTitle').val().length > 2){
        $.ajax({
            url: 'lib/request.php',
            type: 'post',
            dataType: 'text',
            data: ({ searchAnime: $(this).val()}),
            success: function (data) {

                $(".search_result").html(data).fadeIn();
            }
        })
    }
});

$(".search_result").hover(function(){
    $("#animeTitle").blur();
});

$(".search_result").on("click", "li", function(){
    var name = $(this).text();
    //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
    $(".search_result").fadeOut();
    $('#animeTitle').val(name);
});