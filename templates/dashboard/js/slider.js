$('.save-table-data').click(function () {
    var parent =  $(this).parent().parent().parent();
    var tv = parent.find('.change-data-season').val();
    var title = parent.find('.change-data-title').val();
    var img = parent.find('.change-data-img').val();
    var id_slider = $(this).attr('id-slider');
    $.ajax({
        url: '/dashboard/slider/edit',
        type: 'POST',
        data: ({"tv":tv, "title":title, "img":img, "id_slider":id_slider, "token":$('#token').text()}),
        success: function (data) {
            alert(data);
        }
    })
});

$('#saveSlide').click(function () {
    var title = $('#title').val();
    var tv = $('#tv').val();
    var img = $('#img').val();
    $.ajax({
        url: '/dashboard/slider/add',
        type: 'POST',
        data: ({"tv":tv, "title": title, "img": img, "token": $('#token').text()}),
        success: function (data) {
           var response = JSON.parse(data);
            $('#title').val('');
            $('#tv').val('');
            $('#img').val('');
           if (response.status == 200){
               $('tbody').append(response.html)
           }else {
               alert(response.status)
           }
        }
    })
});

$('.remove-table-data').click(function () {
    var id_slider = $(this).attr('id-slider');
    var td = $(this).parent().parent().parent();
    $('#remove').one('click',function () {
        $.ajax({
            url: '/dashboard/slider/delete',
            type: 'POST',
            data: ({"id_slider": id_slider, "token": $('#token').text()}),
            success: function (data) {
                alert(data);
                td.remove();
            }
        })
    })
});