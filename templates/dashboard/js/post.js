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

    if (id == 3){
        $('#viewModal').click();
        $("#deleteSeria").click(function () {
            seriaControls(array,id)
        })
        $('#net').click(function () {
            $(".default").prop("selected", true);
            return true;
        })

    }else {
        $('body').loadingModal({
            text:'Подождите...',
            position:'auto',
            color:'#2E59D9',
            opacity:'0.7',
            backgroundColor:'rgb(0,0,0)',
            animation:'foldingCube'
        });
        seriaControls(array,id)
    }

})
function seriaControls(array, id) {
    $.ajax({
        url: '/dashboard/post/seria/edit',
        type: 'POST',
        data: ({"token":$('#token').text(), "seria":JSON.stringify(array), "type":id}),
        success: function (data) {
            $(".default").prop("selected", true);
            $('body').loadingModal('destroy');
            var response = JSON.parse(data);
            if (response.status == 200){
                if (response.type == 1){
                    // исправление
                    alert("Исправлено кол-во " + response.countCorrect + " серии. Обнови страницу!");
                }else if(response.type == 3){
                    for(var key in array){
                        $('#'+array[key]).closest('div .parent').remove();
                    }
                    // action.closest('div .parent').remove();
                }else {
                    // Обновление серии
                }

            }
        }
    })
}