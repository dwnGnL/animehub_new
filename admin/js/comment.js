$('#like').click(function () {
    $.ajax({
        url: 'index.php',
        type: 'POST',
        dataType: 'text',
        data: ({get: 'get'}),
        success: function (data) {
            var id_post = location.search.replace('?', '').split('=');
            var id_user = data;
            id_user = id_user.replace(/\s/g, '');
            var type = 1;




            $.ajax({
                url: 'lib/comment.php',
                type: 'POST',
                dataType: 'text',
                data:({post: id_post[1], user: id_user, like_type: type}),
                success: function (data) {
                    var re = JSON.parse(data);
                    if(re['id'] == 0){
                        $('#re').html(re['re'] );
                    }else if (re['id'] == 1) {
                        var countLike =  $('#countLike').html();
                 countLike = parseInt(countLike) + parseInt(re['re']);
                        $('#countLike').html(countLike);
                        changeRating();
                        updateRating(id_post[1]);
                    }
                }
            })
        }
    })
});


$('#dislike').click(function () {
    $.ajax({
        url: 'index.php',
        type: 'POST',
        dataType: 'text',
        data: ({get: 'get'}),
        success: function (data) {
            var id_post = location.search.replace('?', '').split('=');
            var id_user = data;
            id_user = id_user.replace(/\s/g, '');
            var type = 0;





            $.ajax({
                url: 'lib/comment.php',
                type: 'POST',
                dataType: 'text',
                data:({post: id_post[1], user: id_user, like_type: type}),
                success: function (data) {
                    var re = JSON.parse(data);
                    if(re['id'] == 0){
                        $('#re').html(re['re'] );
                    }else if (re['id'] == 1) {
                        var countDislike =  $('#countDislike').html();
                        countDislike = parseInt(countDislike) + parseInt(re['re']);
                        $('#countDislike').html(countDislike);
                        changeRating();
                        updateRating(id_post[1]);
                    }
                }
            })
        }
    })
});





function changeRating(){
    var countDisloke = $('#countDislike').html();
    var countLike = $('#countLike').html();
    var total =  parseInt(countDisloke) + parseInt(countLike);
    var rating = 0;

    rating = countLike * 100 / total;
    $('#rating').html(rating + '%');
}

$('.otvet').click(function () {
    
   var otvet = $(this).closest('.ready_comment').find('.avtor').text();
   CKEDITOR.instances['textComment'].setData("<strong>"+otvet+"</strong>,");
   $(document).ready(function () {
   var destination = $("#cke_textComment").offset().top;
  
       $('html').animate({ scrollTop: destination }, 500);
   
   
});

editor.on( 'instanceReady', function() {
    editor.focus();
  } );
})


$('#sendComment').click(function () {

        var text = CKEDITOR.instances['textComment'].getData();
        CKEDITOR.instances['textComment'].setData('');
        if(text == ''){

            exit;
        }else {
            $('#textComment').removeClass('border-warning');
            $.ajax({
                url: 'index.php',
                type: 'POST',
                dataType: 'text',
                data: ({get: 'get'}),
                success: function (data) {
                    var id_post = location.search.replace('?', '').split('=');
                    var id_user = data;
                    id_user = id_user.replace(/\s/g, '');


                    $.ajax({
                        url: 'lib/comment.php',
                        type: 'POST',
                        dataType: 'text',
                        data: ({idpost: id_post[1],type_post: id_post[0], iduser: id_user, textComment: text, token: $('#token').val()}),
                        success: function (data) {
                            var getDate = JSON.parse(data);
                            var styleLog = '';
                            var styleStatus = '';
                            if(getDate['status'] != 0) {
                                styleStatus = 'style = "Color: red"';
                                styleLog = "style = '" + getDate['login_color'] + "'";
                            }

                            var comment = "<div class='ready_comment' style='"+getDate['back_fon']+" background-size:100% 100%;\'>";
                            comment += '<img src="'+getDate['img']+'" width=55 height=55 alt="">';
                            comment += '<p>Автор: </p><span class="avtor" '+styleLog+'>'+getDate['login']+'</span>';
                            comment += '<p '+styleStatus+'>'+getDate['title']+'</p><br>';
                            comment += '<p class="data">' + getDate['date'] + '</p>';
                            comment += '<div id="mugambo">';
                            comment += getDate['body'];
                            comment += '<hr>';
                            comment += '<p style="font-size:14px;font-style: italic;font-variant: sub;box-shadow: lightcoral;">'+getDate['vip_status']+'</p>';
                            comment += '</div></div>';

                            $('#comments').prepend(comment);
                            $('#textComment').val('');

                        }
                    })
                }
            })
        }
    });





function updateRating(id_post) {

   $.ajax({
       url: 'lib/comment.php',
       type: 'post',
       dataType: 'text',
       data: ({ratingPost:  $('#rating').html(), id_rating: id_post}),

   })
}

