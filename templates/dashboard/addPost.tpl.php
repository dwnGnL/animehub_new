<link href="<?=$uri?>/templates/dashboard/css/chosen.css?<?=filemtime('templates/dashboard/css/chosen.css')?>" rel="stylesheet" type="text/css">
<link href="<?=$uri?>/templates/dashboard/css/pagination.css?<?=filemtime('templates/dashboard/css/pagination.css')?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/cat.css?<?=filemtime('templates/dashboard/css/cat.css')?>">
<link rel="stylesheet" href="<?=$uri?>/templates/font-awesome/css/all.css?<?=filemtime('templates/font-awesome/css/all.css')?>">
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Добавление постов</h1>

  <form class="">
    <label><span class="label-item">Выбрать тип:</span>
      <select>
          <?php foreach ($types as $type): ?>
        <option value="<?=$type['title_type']?>"><?=$type['title_type']?></option>
          <?php endforeach; ?>
      </select>
    </label>
    <label><span class="label-item">Название:</span><input type="text" placeholder="Название"></label>
    <label><span class="label-item">Альтернативное название:</span><input type="text" placeholder="Альтернативное название"></label>
    <label><span class="label-item">Сезон:</span><input type="text" placeholder="Сезон"></label>
    <label><span class="label-item">Картинка:</span><input type="text" placeholder="Картинка"></label>
    <label><span class="label-item">Жанр:</span>
      <!-- <select data-placeholder="Выбирите категорию" class="chosen-select" multiple tabindex="4">
        <option value=""></option>
          <?php foreach ($cats as $cat): ?>
        <option value="<?=$cat['title']?>"><?=$cat['title']?></option>
          <?php endforeach; ?>
      </select> -->
      <div class="search-block">
      <span class="finding__elem-block"></span>
      <input class="search-input" type="text" placeholder="Выберите категорию">
    </div>
  </label>
  <ul class="gener-list">
      <?php foreach ($cats as $cat): ?>
      <li class="list-item"><?=$cat['title']?></li>
          <?php endforeach; ?>
    </ul>
      
    <label><span class="label-item">Год выпуска:</span><input type="text" placeholder="Год выпуска"></label>
    <label><span class="label-item">Описание:</span><textarea placeholder="Описание"></textarea></label>

    <input type="button" name="save" value="Сохранить">
  </form>
</div>

<script src="<?=$uri?>/templates/dashboard/js/cat.js"></script>