$("#kalbosa").on("click", function () {    $('#rlyTitle').val($('#titleAnimeForSort').val());    var count = $.trim($('#titleAnimeForSort').val());    if( count.length > 0) {        $('#titleAnimeForSort').removeClass('border-warning')        $.ajax({            url: "lib/request.php",            type: "POST",            dataType: "text",            data: ({sort: $("#titleAnimeForSort").val()}),            beforeSend: funcbeforeSort,            success: funcSuccesSort        })        $('#titleAnimeForSort').val('');    }else {        $('#titleAnimeForSort').addClass('border-warning')    }});// удаление серии аниме из таблицы парсерfunction removeParse(){    $('.removeParse').click(function () {        var id = $(this).attr('id');        var number = $(this).attr('data-id');        $.ajax({            url: 'lib/request.php',            type: 'POST',            dataType: 'text',            data: ({id_parse: id}),            success: function () {                $('#div' + id).remove();                var lenthSer = $('.ser').length;                $('#lengthSer').val(lenthSer);                if (lenthSer  == 0){                    $('#prichina').remove();                }                var plus = 0;                var minus = 0;                for (var i = 1; i <= lenthSer + 1; i++){                    if (i == number){                        console.log('kalbosa');                        plus = 1;                    }                    if (number <= i){                        minus = 1;                        console.log(minus)                    }                        $('#ser' + i).prop({'name': 'ser' + (i - minus), 'id': 'ser' + (i - minus)});                        $('#tv' + i ).prop({'name': 'tv' + (i - minus),'id': 'tv' + (i - minus) });                        $('[data-id = "'+i+'"]'  ).attr('data-id', i - minus);                }            }        })    });}// -----------------------------------------// $('document').ready(function () {//     var reg = /\d+/g;//     var s = "kalbosa 22";//     var m;//     dateTime = new Date();//     console.log( dateTime.toUTCString()  );////     s.toString();//   alert(findNumber(s.toString()))  ;//     // while((m = reg.exec(s)) != null) {//     //     //     alert(m)//     //     // }// });function findNumber(string){    var number = '';    for (var i = 0; i < string.length; i++){        switch (string[i]) {            case '0':                number += string[i];                continue;            case '1':                number += string[i];                continue;            case    '2' :                number += string[i];                continue;            case '3':                number += string[i];                continue;            case '4':                number += string[i];                continue;            case '5':                number += string[i];                continue;            case '6':                number += string[i];                continue;            case '7':                number += string[i];                continue;            case '8':                number += string[i];                continue;            case '9':                number += string[i];        }    }    return number;} function  funcbeforeSort(){     $("#kalbosa").val("Wait is over");     $(".data").remove(); }function funcSuccesSort(data) {    var formInput = '<div class="container" id="formInput">';    $('#formContent').html(formInput);    var Json = JSON.parse(data);    var out = '';    var i = 0;    for (var key in Json) {        i++;        out += '<div class="form-group form-inline" id="div'+Json[i].id+'">';        out += '<br><input value=' + Json[i].ser +' type="text" name='+ 'ser' + i + ' class="one form-control mr-sm-2 ser w-25" id="ser'+i+'" data-id="'+i+'"> ';        out += '<input value=' + '"'+ Json[i].tv + '"'+ ' type="text" name='+ 'tv' + i +' class="two form-control mr-sm-2 tv w-25" id="tv'+i+'" data-id="'+i+'">';        out += '<textarea name="" id="" cols="100" rows="2"   class="textarea md-textarea form-control mt-2 w-75" >'+Json[i].title +'</textarea>';        out += '<i class="btn btn-danger waves-effect removeParse btn'+i+'" id="'+Json[i].id+' " data-id="'+i+'">X</i>';        out += '</div>';        }    $('#formInput').html(out);    var prichina = '<input name="prichina" type="text" class="form-control" id="prichina" placeholder="Причина обновление">';    $("#formInput").append(prichina);    removeParse();    saveSort();    $('#lengthSer').val($('.ser').length);    click();}function saveSort() {    $("#btnSort").click(function () {        var length = $.trim($('#animeTitle').val());        $('#animeTitle').removeClass('border-warning');        console.log($('#formSort').serialize());        if(length.length > 0){            $('#waitOver').removeClass('invisible');        $.ajax({            url: "lib/request.php",            type: 'POST',            datatype: 'json',            data: $('#formSort').serialize() ,            success: function (data) {                $('#waitOver').addClass('invisible');            }        })        }else {            $('#animeTitle').addClass('border-warning');            alert('Заполните поля "Название аниме"!');            return false;        }        $('#formInput').remove();    });}// add Channel$('#saveChannel').click(function () {    $.ajax({        url: 'lib/request.php',        type: 'POST',        datatype: 'text',        data: ({channel: $('#addChannel').val()}),        success: function (data) {            $('#suck').html(data)        }    });    $('#addChannel').val('');});$('#findTitleAnimeSrc').click(function () {    viewInput();});$('#saveChangeSrc').click(function () {    $.ajax({        url: 'lib/request.php',        type: 'POST',        datatype: 'text',        data: $('#formChangeSrc').serialize(),        success: function (data) {            $('.one_obj').remove();            $('#inputСount').val($('.count').length);            alert(data);        }    })});$('#ispravit').click(function () {    $.ajax({        url: 'lib/comment.php',        type: 'POST',        datatype: 'text',        data: $('#formChangeSrc').serialize(),        success: function (data) {            $('.one_obj').remove();            $('#inputСount').val($('.count').length);            alert(data);            viewInput();        }    })});function viewInput(){    var title = $('#titleAnimeSrc').val();    var tv = $('#tvAnimeSrc').val();    $('.one_obj').remove();    $.ajax({        url: 'lib/request.php',        type: 'POST',        datatype: 'text',        data: ({titleAnimeSrc: title, tvAnimeSrc: tv}),        success: function (data) {            var getData = JSON.parse(data);            var input = '';            for ( var id in getData){                input += '<div class="one_obj">';                input += '<input class="count" type="text" name="id' + id + '"  value="'+getData[id].id + '">';                input += '<input type="text" name="title' + id + '"  value="'+getData[id].title + '">';                input += '<input type="text" class="src" name="src' + id + '"  value="'+getData[id].src + '">';                input += '<input  type="text" name="tv' + id + '"  value="'+getData[id].tv + '">';                input += '<input type="text" name="ser' + id + '"  value="'+getData[id].seria + '">';                input += '<input type="text" name="stud' + id + '"  value="'+getData[id].stud + '">';                input += '<input type="text" class="kach" name="kach' + id + '"  value="'+getData[id].kach + '">';                input += '<input type="text" class="mix_title" name="mix_title' + id + '"  value="'+getData[id].mix_title + '">';                input += '<input type="text" class="rly_path" name="mix_title' + id + '"  value="'+getData[id].rly_path + '">';                input +='</div>';                input += '<i class="fa fa-trash" aria-hidden="true" id="'+getData[id].id + '">asdas</i>';            }            $('.inputView').append(input);            $('#inputСount').val($('.count').length);        }    })}function click(){    var tv = {};    $('.tv').on('click', function () {       var id = $(this).attr('data-id');        var click = 0;        if( localStorage.getItem('currentId') == id){            var click = localStorage.getItem('click');            if(click != 3){                click++;                localStorage.setItem('click', click);            }        }else {            localStorage.setItem('currentId', id);            click++;            localStorage.setItem('click', click);        }       var end = 0;       var start = '';        if($(this).val()){            localStorage.setItem('start', id);            $(this).addClass('bg-success')        }       if(localStorage.getItem('start')){           start  = localStorage.getItem('start');       }              if(click == 3){           localStorage.clear();           localStorage.setItem('end', id);       }        localStorage.setItem('start', start);       if(localStorage.getItem('start') >= 1 && localStorage.getItem('end') >= 2){           helperSort(localStorage.getItem('start'), localStorage.getItem('end'));       }    });} function helperSort(start, end){    var value = $('#tv' + start).val();    for (var i = start; i <= end; i++){            $('#tv' + i).val(value);    }    localStorage.clear();    $('.tv').removeClass('bg-success');}// $('#titleAnimeForSort').on('click', function () {//     var out = $(this).attr('name');//     alert(out);// });