$('.delete').click(function () {
    var idPost = $(this).attr('delete-id');
     $('#yes').click(function () {


             $.ajax({
                 url: 'lib/request.php',
                 type: 'POST',
                 datatype: 'text',
                 data: ({idPostForDeletePost: idPost}),
                 success: function () {
                     $('#' + idPost).remove();
                 }
             })


    });


});

$('#btnEditPost').click(function () {
  alert( ($('#postFormEdit').serialize()));
    $.ajax({
        url: 'lib/request.php',
        type: 'POST',
        datatype: 'text',
        data:  $('#postFormEdit').serialize(),
        success: function (data) {

        }
    });


});


$('#deleteComment').click(function () {
    var idComment = $(this).attr('delete-id');
    $('#yes').click(function () {


        $.ajax({
            url: 'lib/request.php',
            type: 'POST',
            datatype: 'text',
            data: ({idComment: idComment}),
            success: function () {
                $('#' + idComment).remove();
            }
        })


    });

});