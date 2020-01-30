$('#search').on('input keyup change click', function () {
    var input = $('#search').val();
    if (input.length > 2) {

        $.ajax({
            url: '/ajax/search/posts',
            type: 'POST',
            data: ({'title': input, 'token': $('#token').text()}),
            success: function (data) {
                $('tbody').html(data);
            }
        })
    }
});

function deletePost(){
    $('.remove-table-data').one( 'click', function () {
        var id_post = $(this).attr('id-post');
        var tr = $(this).parent().parent().parent();
        $('#remove').one('click', function () {
            $.ajax({
                url: '/dashboard/post/delete',
                type: 'POST',
                data: ({'id': id_post, 'token':$('#token').text()}),
                success: function (data) {
                    alert(data);
                    tr.remove();
                }
            })
        })
    });
}
deletePost();