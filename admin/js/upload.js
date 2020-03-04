$(function () {
    $('#file').change(function () {

        $('#load').append("<img src='/img/loader.gif' alert='Loading' style='margin-top: 20px;'>");

        $('#sliderForm').ajaxForm({
            success: function (data) {
                alert(data);
            }
        }).submit();
    })
});