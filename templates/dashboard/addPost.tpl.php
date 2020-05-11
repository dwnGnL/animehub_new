<link href="<?=$uri?>/templates/dashboard/css/chosen.css?<?=filemtime('templates/dashboard/css/chosen.css')?>" rel="stylesheet" type="text/css">
<link href="<?=$uri?>/templates/dashboard/css/pagination.css?<?=filemtime('templates/dashboard/css/pagination.css')?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/cat.css?<?=filemtime('templates/dashboard/css/cat.css')?>">
<link rel="stylesheet" href="<?=$uri?>/templates/font-awesome/css/all.css?<?=filemtime('templates/font-awesome/css/all.css')?>">
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Добавление постов</h1>

  <form id="addPostForm">
    <label><span class="label-item">Выбрать тип:</span>
      <select name="type">
          <?php foreach ($types as $type): ?>
        <option value="<?=$type['id_type']?>"><?=$type['title_type']?></option>
          <?php endforeach; ?>
      </select>
    </label>
    <label><span class="label-item">Название:</span><input type="text" placeholder="Название" name="title"></label>
    <label><span class="label-item">Альтернативное название:</span><input type="text" name="alt_title" placeholder="Альтернативное название"></label>
    <label><span class="label-item">Сезон:</span><input type="text" placeholder="Сезон" name="sezon"></label>
    <label><span class="label-item">Картинка:</span><input type="text" placeholder="Картинка" name="image"></label>
    <label><span class="label-item">Жанр:</span>
      <div class="search-block-main">
      <span class="finding__elem-block"></span>
      <input class="search-input" type="text" placeholder="Выберите категорию">
    <ul class="gener-list">
      <?php foreach ($cats as $cat): ?>
      <li class="list-item" cat-id="<?=$cat['id']?>"><?=$cat['title']?></li>
          <?php endforeach; ?>
    </ul>
    </div>

  </label>

      
    <label><span class="label-item">Год выпуска:</span><input type="text" placeholder="Год выпуска" name="god_wip"></label>
    <label><span class="label-item">Описание:</span><textarea placeholder="Описание" name="description"></textarea></label>

    <input type="button" id="addPost" value="Сохранить">
  </form>
</div>

<script src="<?=$uri?>/templates/dashboard/js/cat.js"></script>