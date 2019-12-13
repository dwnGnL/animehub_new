$('#sohr').click(function () {
    console.log($('#name').val());
    console.log($('#city').val());
    $.ajax({
        url: 'lib/ajax_php.php',
        success: function (data) {
            var user = JSON.parse(data);
            $.ajax({
                url: 'lib/comment.php',
                type: 'POST',
                dataType: 'text',
                data: ({id_user: user['id'], pol: $('select[name="pol"]').val(), age: $('#age').val(), userName: $('#name').val(), city: $('#city').val() }),
                success: function () {
                    var  pol = '';
                    if ($('select[name="pol"]').val() == 1){
                        pol = 'Мужской';
                    }else if($('select[name="pol"]').val() == 2) {
                        pol = 'Женский';
                    }
                    $('#curAge').html($('#age').val());
                    $('#curName').html($('#name').val());
                    $('#curCity').html($('#city').val());
                    $('#curPol').html(pol);
                }
            })
        }
    })
});

$('.avarar').click(function () {
    var ava = $(this).attr('src');
    $.ajax({
        url: 'lib/ajax_php.php',
        success: function(data){
            var user = JSON.parse(data);
        $.ajax({
            url: 'lib/comment.php',
            type: 'POST',
            dataType: 'text',
            data: ({avatar: ava, avatarId: user['id']}),
            
        })
    }
})
});



$('#izmena').click(function () {
    $('#age').val($('#curAge').text());
});

$('#saveVip').click(function () {
    $.ajax({
        url: 'lib/ajax_php.php',
        success: function (data) {
            var user = JSON.parse(data);

            var check = 0;
            if ($('#check').prop('checked') == "1") {
                check = 1
            }

            $.ajax({
                url: 'lib/comment.php',
                type: 'POST',
                dataType: 'text',
                data: ({login_color: $('.login').attr('style'), fon: $('.belii_fon').attr('style'), checked: check, vip_user: user['id'], vip_status: $('#status').val(), font: $('select[name="font"]').val()}),
                success: function (data) {

                }
            })
        }
    })
});

$('#addVip').click(function () {
    $.ajax({
        url: 'lib/comment.php',
        type: 'POST',
        dataType: 'text',
        data: ({loginUser: $('#startVip').val()}),
        success: function (data) {
            if(data != 1){
                alert(data);
            }else {

            }
        }
    })
});

