
    $('#search').on('input keyup change click', function () {
        var input = $('#search').val();
        if (input.length > 2){

            $.ajax({
                url: '/ajax/search/posts',
                type: 'POST',
                data: ({'title':input, 'token': $('#token').text()}),
                success: function (data) {
                    $('tbody').html(data);
                }
            })
        }
    });
