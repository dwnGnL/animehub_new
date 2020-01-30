<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Добавление слайдеров</h1>

  <div class="form">
    <form class="slider-form">
      <label><span>Название аниме:</span><input type="text" value="" id="title"></label>
      <label><span>Сезон:</span><input type="text" value="" name="tv" id="tv"></label>
      <label><span>Ссылка на картинку:</span><input type="text" value="" id="img"></label>
      <input type="file" value="">
      <input type="button" value="Сохранить" id="saveSlide">
    </form>
  </div>


  <table cellspacing="0">
    <thead>
      <tr>
        <th class="title title-slider">Title</th>
        <th class="img-src">Img</th>
        <th class="season">Season</th>
        <th class="button-place-header">Edit/Delete</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($sliders as $slider): ?>
    <?php require 'templates/dashboard/list_slide.tpl.php' ?>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script src="<?=$uri?>/templates/dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?=$uri?>/templates/dashboard/js/slider.js?<?=filemtime('templates/dashboard/js/slider.js')?>"></script>
