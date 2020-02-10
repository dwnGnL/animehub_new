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