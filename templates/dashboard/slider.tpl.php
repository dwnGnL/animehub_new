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
      <tr class="table-row-data">
        <td class="title-slider">
          <span class="title-data data-block"><a href="/anime/<?=$helper::renderUrl($slider['id'],$slider['alias'])?>"><?=$slider['title']?></a></span>
          <input class="change-data-title change-data" type="text">
        </td>

        <td>
          <span class="img-src-data data-block"><?=$slider['img']?></span>
          <input class="change-data-img change-data" type="text">
        </td>

        <td>
          <span class="season-data data-block"><?=$slider['tv']?></span>
          <input class="change-data-season change-data" type="text">
        </td>

        <td>
          <div class="button-place default-buttons active">
            <span class="edit-table-data button-table-data" >Edit</span>
            <span class="remove-table-data button-table-data">Remove</span>
          </div>

          <div class="button-place edit-buttons">
            <span class="save-table-data button-table-data" id-slider="<?=$slider['id_slider']?>">Save</span>
            <span class="cancel-table-data button-table-data">Cancel</span>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script src="<?=$uri?>/templates/dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?=$uri?>/templates/dashboard/js/slider.js"></script>
