$('.save-table-data').click(function () {
    var parent =  $(this).parent().parent().parent();
    var tv = parent.find('.change-data-season').val();
    var title = parent.find('.change-data-title').val();
    alert(title);
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
            alert(data);
        }
    })
});