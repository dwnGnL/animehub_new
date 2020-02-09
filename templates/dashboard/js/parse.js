
//Вывод серии из сортировки
$('#btnForSort').one('click', function () {
    var title = $('#titleForSort').val();
    if (title.length < 3){
        $('#titleForSort').addClass('border-danger');
    }else {
        $('#titleForSort').removeClass('border-danger');
        $.ajax({
            url: '/dashboard/parse/sort',
            type: 'post',
            data: ({"title": title, "token": $('#token').text()}),
            success: function (data) {
                var response = JSON.parse(data);
                if (response.status == 200){
                    $('#formSort').html(response.html);
                    $('#titleForSave').val(title);
                    $('#titleForSort').val('');
                }
            }
        })
    }
});

//Удаление серии из сортировки
$('.remove').on('click',function () {
    var id_parse = $(this).attr('id-remove');
    var parent =  $(this).parent();
    $.ajax({
        url: '/dashboard/parse/delete',
        type: 'POST',
        data: ({"id_parse": id_parse, "token": $('#token').text()}),
        success: function (data) {
            var response = JSON.parse(data);
            if (response.status == 200){
                parent.remove();
            }
        }
    });
});

// Запуск парсера сайтов
$('#startParse').click(function () {
    var title = $('#titleForParse').val();
    var site = $("#site :selected").val();
    var startPage = $("#startPage").val();
    var endPage = $("#endPage").val();
    var startVideo = $("#startVideo").val();
    var endVideo = $("#endVideo").val();
    if (title.trim().length < 3){
        $('#titleForParse').addClass('border-danger');
    }else {
        $('body').loadingModal({
            text:'Идет парсинг...',
            position:'auto',
            color:'#2E59D9',
            opacity:'0.7',
            backgroundColor:'rgb(0,0,0)',
            animation:'foldingCube'
        });
        $('#titleForParse').removeClass('border-danger');
        $.ajax({
            url: '/dashboard/parse/start',
            type: 'POST',
            data: ({"title": title, "site":site, "token": $('#token').text(), "startPage":startPage, "endPage":endPage, "startVideo": startVideo, "endVideo":endVideo}),
            success: function (data) {
                var response = JSON.parse(data);
                viewResult(response.total);
                $('body').loadingModal('destroy');
                $('#titleForParse').val('');
                $("#startPage").val('');
                $("#endPage").val('');
                $("#startVideo").val('');
                $("#endVideo").val('');
            },
        });
    }
});

$('#parseChannel').click(function () {
    var title = $('#titleParseChannel').val();
    var site = $("#channel :selected").val();
    var startPage = $("#startPageCh").val();
    var endPage = $("#endPageCh").val();
    var startVideo = $("#startVideoCh").val();
    var endVideo = $("#endVideoCh").val();
    if (title.trim().length < 3){
        $('#titleParseChannel').addClass('border-danger');
    }else {
        $('body').loadingModal({
            text:'Идет парсинг...',
            position:'auto',
            color:'#2E59D9',
            opacity:'0.7',
            backgroundColor:'rgb(0,0,0)',
            animation:'foldingCube'
        });
        $('#titleParseChannel').removeClass('border-danger');
        $.ajax({
            url: '/dashboard/parse/channel',
            type: 'POST',
            data: ({"title": title, "channel":site, "token": $('#token').text(), "startPage":startPage, "endPage":endPage, "startVideo": startVideo, "endVideo":endVideo}),
            success: function (data) {
                var response = JSON.parse(data);
                viewResult(response.total);
                $('body').loadingModal('destroy');
                $('#titleParseChannel').val('');
                $("#startPageCh").val('');
                $("#endPageCh").val('');
                $("#startVideoCh").val('');
                $("#endVideoCh").val('');
            },
            error: function () {
                $('body').loadingModal('destroy');
            }
        });
    }
});

function viewResult(total) {
    alert('Было спарсено ' + total + ' аниме');
}
function click() {
    var tv = {};
    $('.tv').on('click', function () {

        var id = $(this).attr('data-id');

        var click = 0;

        if( localStorage.getItem('currentId') == id){

            var click = localStorage.getItem('click');
            console.log(localStorage.getItem('click'));

            if(click != 3){

                click++;

                localStorage.setItem('click', click);

            }

        }else {
            localStorage.setItem('currentId', id);

            click++;

            localStorage.setItem('click', click);

        }
        var end = 0;

        var start = '';

        if($(this).val()){

            localStorage.setItem('start', id);

            $(this).addClass('bg-success')

        }

        if(localStorage.getItem('start')){

            start  = localStorage.getItem('start');

        }

        if(click == 3){

            localStorage.clear();

            localStorage.setItem('end', id);

        }
        localStorage.setItem('start', start);

        if(localStorage.getItem('start') >= 1 && localStorage.getItem('end') >= 2){

            helperSort(localStorage.getItem('start'), localStorage.getItem('end'));

        }

    });
}

function helperSort(start, end){
    var value = $('#tv' + start).val();
    for (var i = start; i <= end; i++){
        $('#tv' + i).val(value);
    }
    localStorage.clear();
    $('.tv').removeClass('bg-success');

}
click();