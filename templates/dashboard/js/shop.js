$('#cat').change(function () {
    var id_cat = $('#cat :selected').val();
    $.ajax({
        url: '/dashboard/shop/viewAttr',
        type: 'post',
        data: ({"id_cat": id_cat, "token": $('#token').text()}),
        success: function (data) {
            var response = JSON.parse(data);
            if (response.status == 200){
                $('#attr').html(response.html);
            }

        }
    })
});
$('.deletePr').click(function () {
    var id = $(this).attr('id-product');
    swal({
        title: 'Удаление?',
        text: "Вы точно хоитет удалить?",
        type: 'warning',
        buttons:{
            confirm: {
                text : 'Да',
                className : 'btn btn-success'
            },
            cancel: {
                text: 'Нет',
                visible: true,
                className: 'btn btn-danger'
            }
        }
    }).then((Delete) => {
        if (Delete) {
            $.ajax({
                url: '/dashboard/shop/product/delete/' + id,
                type: 'POST',
                data: ({'token':$('#token').text()}),
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status == 200){
                        $('#' + id).remove();
                        swal({
                            title: 'Удалено!',
                            text: 'Данный товар успешно удален!',
                            type: 'success',
                            buttons : {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            }
                        });
                    }
                }
            });

        } else {
            swal.close();
        }
    });
});