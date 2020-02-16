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