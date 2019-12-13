var autoLoad = '';

$('select[name="one"]').on('change', function () {
    $.ajax({
        url: "lib/request.php",
        type: 'POST',
        datatype: 'text',
        data: ({idKach: $('select[name="two"]').val(), idStud: $('select[name="one"]').val(), title: $('#title').html(), tv: $('#tv').html()}),
        success: function (data) {
            var low = JSON.parse(data);
           $('.listSer').remove();
           var div = ' <div class="listSer"></div>';
            $('#DivSer').append(div);
           var out ='';
           var kach = '';
           var i = 0;
           for(var get in low) {
               if(low[i].id_stud == 1){
                   out = '[AniDub] ';
               }else if(low[i].id_stud == 2){
                   out = '[Anilibria] ';
               }else if(low[i].id_stud == 3){
                   out = '[StudioBand] ';
               }else if(low[i].id_stud == 4){
                   out = '[Anistar] ';
               }else if(low[i].id_stud == 5){
                   out = '[Animedia] ';
               }else if(low[i].id_stud == 7){
                   out = '[AniMaunt] ';
               }else if(low[i].id_stud == 8){
                   out = '[Animevost] ';
               }else {
                   out = '';
               }
               if (low[i].id_kach == 1) {
                   kach = '[HD]'
               }else if(low[i].id_kach == 2){
                   kach = '[SD]'
               }else {
                   kach = '';
               }




               $('.listSer').append( '<p id="'+low[i].id+'" scroll="'+low[i].seria + '" class="pSer"><img src="'+low[i].img+'" width="45"> серия '+low[i].seria + ' ' + out + kach +'</p>');
               i++;

           }
            $('.listSer').append('<script>clickSer();</script>');

        }
    })
});

$('select[name="two"]').on('change', function () {
    $
    $.ajax({
        url: "lib/request.php",
        type: 'POST',
        datatype: 'text',
        data: ({idStud: $('select[name="one"]').val(), idKach: $('select[name="two"]').val(), title: $('#title').html(), tv: $('#tv').html() }),
        success: function (data) {
            var low = JSON.parse(data);
            $('.listSer').remove();
            var div = ' <div class="listSer"></div>';
            $('#DivSer').append(div);
            var out ='';
            var kach = '';
            var i = 0;
            for(var get in low) {
                if(low[i].id_stud == 1){
                    out = '[AniDub] ';
                }else if(low[i].id_stud == 2){
                    out = '[Anilibria] ';
                }else if(low[i].id_stud == 3){
                    out = '[StudioBand] ';
                }else if(low[i].id_stud == 4){
                    out = '[Anistar] ';
                }else if(low[i].id_stud == 5){
                    out = '[Animedia] ';
                }else if(low[i].id_stud == 7){
                    out = '[AniMaunt] ';
                }else if(low[i].id_stud == 8){
                    out = '[Animevost] ';
                }else {
                    out = '';
                }
                if (low[i].id_kach == 1) {
                    kach = '[HD]'
                }else if(low[i].id_kach == 2){
                    kach = '[SD]'
                }else {
                    kach = '';
                }




                $('.listSer').append( '<p id="'+low[i].id+'" scroll="'+low[i].seria + '" class="pSer"><img src="'+low[i].img+'" width="85"> серия '+low[i].seria + ' ' + out + kach +'</p>');
                i++;

            }

            $('.listSer').append('<script>clickSer();</script>');
        }
    })
});



function clickSer() {
    $('.pSer').click(function (event) {
        changeSer($(this))
    })
}






function changeSer(click){
    var clicked = click;
    $('.pSer').removeClass('currentSer');
    clicked.addClass('currentSer');
    $('title').text( $('#title').html() + ' ' + $('#tv').html() + '-'+clicked.text() + ' AnimeHub.tj' );
    $.ajax({
        url: "lib/request.php",
        type: 'POST',
        datatype: 'text',
        data: ({seria: clicked.attr('id'), titlePost: $('#title').html(), tvPost:$('#tv').html() }),
        success: function (data) {


             $("#src").attr("src",data);
             $('video').load();
             $('video').trigger('play');

           if ($("#toggleButton").prop('checked')){

                autoChangeSer(clicked);
           }


        }
    })
}

$('#perehod').click(function(){
    var serii = document.getElementsByClassName("pSer")
   for (var i = 0; i < serii.length; i++) {
	if (serii[i].getAttribute('scroll') ==$('#seria_perehod').val()){
	    var destination = $('*[scroll='+$('#seria_perehod').val()+']').position().top-50;
	    
	}
}
$('.listSer').animate({ scrollTop: destination }, 1100);

    
})

$('document').ready(function () {
        $.ajax({
            url: "lib/request.php",
            type: 'POST',
            datatype: 'text',
            data: ({idStud: $('select[name="one"]').val(), idKach: $('select[name="two"]').val(), title: $('#title').html(), tv: $('#tv').html() }),
            success: function (data) {
                var low = JSON.parse(data);
                $('.listSer').remove();
                var div = ' <div class="listSer"></div>';
                $('#DivSer').append(div);
                var out ='';
                var kach = '';
                var i = 0;
                for(var get in low) {
                    if(low[i].id_stud == 1){
                        out = '[AniDub] ';
                    }else if(low[i].id_stud == 2){
                        out = '[Anilibria] ';
                    }else if(low[i].id_stud == 3){
                        out = '[StudioBand] ';
                    }else if(low[i].id_stud == 4){
                        out = '[Anistar] ';
                    }else if(low[i].id_stud == 5){
                        out = '[Animedia] ';
                    }else if(low[i].id_stud == 7){
                        out = '[AniMaunt] ';
                    }else if(low[i].id_stud == 8){
                        out = '[Animevost] ';
                    }else {
                        out = '';
                    }
                    if (low[i].id_kach == 1) {
                        kach = '[HD]'
                    }else if(low[i].id_kach == 2){
                        kach = '[SD]'
                    }else {
                        kach = '';
                    }




                    $('.listSer').append( '<p id="'+low[i].id+'" scroll="'+low[i].seria + '" class="pSer"><img src="'+low[i].img+'" width="85"> серия '+low[i].seria + ' ' + out + kach +'</p>');
                    i++;

                }

                $('.listSer').append('<script>clickSer();</script>');
            }
        })

});


$(document).ready(function () {
    if($('#title').html() && $('#tv').html()){
        $('title').text('AnimeHub.tj ' + $('#title').html() + ' ' + $('#tv').html());
    }else {
        return false;
    }
});


    function autoChangeSer(click) {
        document.getElementById('movie').addEventListener('ended',myHandler,false);
    
        function myHandler(e) {
            if(click.next()){
              changeSer(click.next())
            }
    
        }
    
    }
 $('#autoPlay').click(function () {
     var check = '';
    if ( $("#toggleButton").prop('checked')){
        check = 1;
    }else {
        check = 0;
    }
    console.log(check);
     $.ajax({
         url: 'lib/comment.php',
         method: 'POST',
         datatype: 'TEXT',
         data: ({autoPlay: check})
     })
 });