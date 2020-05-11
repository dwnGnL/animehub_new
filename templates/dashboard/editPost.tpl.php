<link href="<?=$uri?>/templates/dashboard/css/chosen.css?<?=filemtime('templates/dashboard/css/chosen.css')?>" rel="stylesheet" type="text/css">
<link href="<?=$uri?>/templates/dashboard/css/pagination.css?<?=filemtime('templates/dashboard/css/pagination.css')?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/cat.css?<?=filemtime('templates/dashboard/css/cat.css')?>">
<link rel="stylesheet" href="<?=$uri?>/templates/font-awesome/css/all.css?<?=filemtime('templates/font-awesome/css/all.css')?>">
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
      <label><span class="label-item">Жанр:</span>
          <div class="search-block-main">
              <span class="finding__elem-block">
                  <?php foreach ($postCats as $postCat): ?>
                        <span class="finding__elem">
                            <?=$postCat['title']?>
                            <span class="cross" data-index="<?=$postCat['id']?>">
                            </span>
                        </span>
                  <?php endforeach; ?>
              </span>
              <input class="search-input" type="text" placeholder="Выберите категорию">
              <ul class="gener-list">
                  <?php foreach ($cats as $cat): ?>
                    <?php foreach ($postCats as $postCat): ?>
                        <?php if ($cat['id'] == $postCat['id']): ?>
                              <li class="list-item show choosed" cat-id="<?=$cat['id']?>"><?=$cat['title']?></li>
                        <?php else: ?>
                              <li class="list-item" cat-id="<?=$cat['id']?>"><?=$cat['title']?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>


                  <?php endforeach; ?>
              </ul>
          </div>

      </label>
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
                    <option value="2">Обновить студию</option>
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
        <div class="col-md-12 row parent" id="<?=$value['id']?>">
            <div class="col-md-1 form-group">
                <input type="number" class="form-control ser enter" data-type="1"  value="<?=$value['seria']?>">
            </div>
            <div class="col-md-3 form-group">
                <input type="text" class="form-control stud" value="<?=$value['stud']?>" disabled>
            </div>
            <div class="col-md-7 form-group">
                <input type="text" class="form-control enter" id="src<?=$value['id']?>" data-type="3" value="<?=$value['src']?>">
            </div>
            <div class="custom-control custom-checkbox form-group col-md-1">
                <input type="checkbox" class="check">
            </div>
        </div>
        <?php endforeach; ?>
        <button data-toggle="modal" data-target="#delete" id="viewModal" hidden>клик</button>
        <div class="col-md-6 mt-4">
            <select name="action" id="action" class="form-control action">
                <option value="Исправить" disabled selected class="default">Выберите действие</option>
                <option value="1">Исправить</option>
                <option value="2">Обновить студию</option>
                <option value="3" data-toggle="modal" data-target="#delete">Удалить</option>
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

<button data-toggle="modal" data-target="#stud" id="viewStud" hidden>клик</button>
<div class="modal fade" id="stud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Обновление студии</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Выберите студию</div>
                <div class="form-group mx-3">
                    <select name="stud" id="pickStud" class="form-control">
                        <option value="0" selected disabled>Выберите студию</option>
                        <?php foreach ($studs as $stud): ?>
                        <option value="<?=$stud['id']?>"><?=$stud['title']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="updateStud" type="button" data-dismiss="modal">Изменить</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal" id="net">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=$uri?>/templates/dashboard/js/cat.js"></script>