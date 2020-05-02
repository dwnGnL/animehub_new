$('.container-fluid').on('click','.all-check', function () {
    if ($(this).prop('checked')){
        $('.check').prop('checked', true)
        $('.all-check').prop('checked', true)

    }else {
        $('.check').prop('checked', false)
        $('.all-check').prop('checked', false)
    }

})

$('.action').change(function () {
    var array = [],
        i = 0,
        id = $(this).val();
    $('.check').each(function () {
        if ($(this).prop('checked')){
            array[i] = $(this).attr('id');
            i++;
        }

    })
    $('body').loadingModal({
        text:'Подождите...',
        position:'auto',
        color:'#2E59D9',
        opacity:'0.7',
        backgroundColor:'rgb(0,0,0)',
        animation:'foldingCube'
    });
    $.ajax({
        url: '/dashboard/post/seria/edit',
        type: 'POST',
        data: ({"token":$('#token').text(), "seria":JSON.stringify(array), "type":id}),
        success: function (data) {
            $('body').loadingModal('destroy');
            var response = JSON.parse(data);
            if (response.status == 200){
                if (response.type == 1){
                    // исправление
                    alert("Исправлено кол-во " + response.countCorrect + " серии. Обнови страницу!");
                }else if(response.type == 2){
                    // action.closest('div .parent').remove();
                }else {
                    // Обновление серии
                }

            }
        }
    })
})