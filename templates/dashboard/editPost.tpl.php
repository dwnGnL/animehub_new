<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Добавление постов</h1>

  <form class="">
    <label><span class="label-item">Выбрать тип:</span>
      <select>
          <option value="<?=$post['type']?>"><?=$post['type']?></option>
        <option value="anime">anime</option>
        <option value="dorama">dorama</option>
        <option value="articles">articles</option>
      </select>
    </label>
    <label><span class="label-item">Название:</span><input type="text" placeholder="Название" value="<?=$post['title']?>"></label>
    <label><span class="label-item">Альтернативное название:</span><input type="text" placeholder="Альтернативное название" value="<?=$post['alias']?>"></label>
    <label><span class="label-item">Сезон:</span><input type="text" placeholder="Сезон" value="<?=$post['tv']?>"></label>
    <label><span class="label-item">Картинка:</span><input type="text" placeholder="Картинка" value="<?=$post['image']?>" ></label>
    <label><span class="label-item">Жанр:</span><input type="text" placeholder="Жанр" ></label>
    <div>
      <div>
        <span>dsadsa</span>
      </div>
    </div>
    <label><span class="label-item">Год выпуска:</span><input type="text" placeholder="Год выпуска" value="<?=$post['god']?>" ></label>
    <label><span class="label-item">Описание:</span><textarea placeholder="Описание"  ><?=$post['body']?></textarea></label>

    <input type="button" name="save" value="Сохранить">
  </form>
    <div class="row mt-2 mb-5">
            <div class="col-md-6 mb-4">
                <select name="action" id="action" class="form-control action">
                    <option value="0" disabled selected class="default">Выберите действие</option>
                    <option value="1">Исправить</option>
                    <option value="2">Обновить</option>
                    <option value="3" data-toggle="modal" data-target="#delete">Удалить</option>
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <div class="custom-control  form-group">
                    <span>Выделить все</span>
                    <input type="checkbox" class="all-check">
                </div>
            </div>
        <?php foreach ($anime as $value): ?>
        <div class="col-md-12 row parent">
            <div class="col-md-1 form-group">
                <input type="number" class="form-control ser" value="<?=$value['seria']?>">
            </div>
            <div class="col-md-3 form-group">
                <input type="text" class="form-control stud" value="<?=$value['stud']?>">
            </div>
            <div class="col-md-7 form-group">
                <input type="text" class="form-control" value="<?=$value['src']?>">
            </div>
            <div class="custom-control custom-checkbox form-group col-md-1">
                <input type="checkbox" class="check" id="<?=$value['id']?>">
            </div>
        </div>
        <?php endforeach; ?>
        <button data-toggle="modal" data-target="#delete" id="viewModal" hidden>клик</button>
        <div class="col-md-6 mt-4">
            <select name="action" id="action" class="form-control action">
                <option value="Исправить" disabled selected class="default">Выберите действие</option>
                <option value="1">Исправить</option>
                <option value="2">Обновить</option>
                <option value="3" >Удалить</option>
            </select>
        </div>

        <div class="col-md-6 mt-4">
            <div class="custom-control  form-group">
                <span>Выделить все</span>
                <input type="checkbox" class="all-check">
            </div>
        </div>
    </div>
</div>

<!--modal-->

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Вы точно хотите удалить?</div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="deleteSeria" type="button" data-dismiss="modal">Да</button>
                <button class="btn btn-success" type="button" data-dismiss="modal" id="net">Нет</button>

            </div>
        </div>
    </div>
</div>