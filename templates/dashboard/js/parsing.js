let parseAnimeName = document.querySelectorAll('.parse-anime-name');
let animeName = '';

parseAnimeName.forEach((elem, index) => {
  elem.oninput = () => {
    animeName = elem.value;
    console.log(animeName);
  };

  elem.onblur = () => {
    for (let i = 0; i < parseAnimeName.length; i++) {
      parseAnimeName[i].value = animeName;
      parseAnimeName[i].classList.add('checked');
      if (elem.value == '' || elem.value == ' ') parseAnimeName[i].classList.remove('checked');
    };
  };
});

// Сохранение сортированных аниме
$('#save').on('click', function () {
  var array = $('#sortForm').serializeArray();
  $.ajax({
    url: '/dashboard/parse/save',
    type: 'POST',
    data: ({"anime": array, "token": $('#token').text(), "title": $('#titleForSave').val()}),
    success: function (data) {
      var response = JSON.parse(data);
      if (response.status == 200) {
        $('#formSort li').remove();
        $('#titleForSave').val('');
      }
    },
    error: function () {
      $('#formSort li').remove();
      $('#titleForSave').val('');
    }
  })
});

//Вывод серии из сортировки
$('#btnForSort').on('click', function () {
  var title = $('#titleForSort').val();
  if (title.length < 3){
    $('#titleForSort').addClass('border-danger');
  }else {
    $('#titleForSort').removeClass('border-danger');
    $.ajax({
      url: '/dashboard/parse/sort',
      type: 'post',
      data: ({"title": title, "token": $('#token').text()}),
      success: function (data) {
        var response = JSON.parse(data);
        if (response.status == 200){
          $('#formSort').html(response.html);
          $('#titleForSave').val(title);
          $('#titleForSort').val('');
        }
      }
    })
  }
});

//Удаление серии из сортировки
