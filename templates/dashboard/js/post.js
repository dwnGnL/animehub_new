

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
            array[i] = $(this).closest('.parent').attr('id');
            i++;
        }

    })

    if (id == 3){
        $('#viewModal').click();
        $("#deleteSeria").one("click",function () {
            seriaControls(array,id)
        })
        $('#net').one("click",function () {
            $(".default").prop("selected", true);
            return true;
        })

    }else if(id == 2){
        $('#viewStud').click();
        $(".default").prop("selected", true);
        $("#updateStud").one('click',function () {
            seriaControls(array,id,$('#pickStud').val() )
        })
    }else {
        displayAnimate();
        seriaControls(array,id)
    }

})
function seriaControls(array, id, stud = '') {
    $.ajax({
        url: '/dashboard/post/seria/edit',
        type: 'POST',
        data: ({"token":$('#token').text(), "seria":JSON.stringify(array), "type":id, "stud": stud}),
        success: function (data) {
            $(".default").prop("selected", true);
            displayAnimateDestroy();
            var response = JSON.parse(data);
            if (response.status == 200){
                if (response.type == 1){
                    // исправление
                    for (var key in response.change){
                        $('#src'+response.change[key].id)
                            .val(response.change[key].src)
                            .addClass("border-success")
                    }
                    alert("Исправлено " + response.countCorrect + " серии");
                }else if(response.type == 3){
                    for(var key in array){
                        $('#'+array[key]).remove();
                    }
                    // action.closest('div .parent').remove();
                }else if (response.type == 2){
                    for (var key in array){
                        $('#'+array[key]).find('.stud').val(response.stud);
                    }
                }

            }
        }
    })
}

$('.enter').keypress("input",function (event) {
   if ( event.which === 13){
        displayAnimate();
        var id =$(this).closest('.parent').attr('id'),
            type = $(this).attr('data-type'),
            data = $(this).val();
        $.ajax({
            url: '/dashboard/post/seria/edit',
            type: 'POST',
            data: ({"token":$('#token').text(), "id": id, "type":4, "input": type, 'data':data}),
            success: function (data) {
                displayAnimateDestroy();
                var response = JSON.parse(data);
                if (response.status == 200){
                    $('#' +response.id).find("[data-type='"+type+"']").addClass("border-success")
                }
            }
        })

   }
})

function displayAnimate() {
    $('body').loadingModal({
        text:'Подождите...',
        position:'auto',
        color:'#2E59D9',
        opacity:'0.7',
        backgroundColor:'rgb(0,0,0)',
        animation:'foldingCube'
    });
}

function displayAnimateDestroy() {
    $('body').loadingModal('destroy');
}


// Добавление поста

function choosedCats() {
    let cats = [];
    $('.cross').each(function (i) {
        cats[i] = $(this).attr('data-index');
    })
    return JSON.stringify(cats)
}

$('body').on('click', '#addPost',function () {
    displayAnimate();
    const cats = choosedCats();
    const formData = $('#addPostForm').serializeArray();
    $.ajax({
        url: '/dashboard/post/addPost',
        type: 'POST',
        data: ({formData, 'cats': cats, "token":$('#token').text()}),
        success: function (data) {
            displayAnimateDestroy();
            var response = JSON.parse(data);
            if (response.status == 200){
                $('form input, form textarea').val('');
                alert('Пост успешно добавлен!')
                // тут очистка категории
            }
        }
    })
})

//Обновление поста

$('body').on('click', '#updatePost',function () {
    displayAnimate();
    const cats = choosedCats();
    const formData = $('#addPostForm').serializeArray();
    $.ajax({
        url: '/dashboard/post/update',
        type: 'POST',
        data: ({formData, 'cats': cats, "token":$('#token').text(), "id_post": $('#id_post').val()}),
        success: function (data) {
            displayAnimateDestroy();
            var response = JSON.parse(data);
            if (response.status == 200){
                alert('Пост успешно обновлен!');
            }
        }
    })
})