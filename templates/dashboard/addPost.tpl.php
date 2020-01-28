<link href="<?=$uri?>/templates/dashboard/css/chosen.css" rel="stylesheet" type="text/css">
<link href="<?=$uri?>/templates/dashboard/css/pagination.css" rel="stylesheet" type="text/css">
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Добавление постов</h1>

  <form class="">
    <label><span class="label-item">Выбрать тип:</span>
      <select>
        <option value="anime">anime</option>
        <option value="dorama">dorama</option>
        <option value="articles">articles</option>
      </select>
    </label>
    <label><span class="label-item">Название:</span><input type="text" placeholder="Название"></label>
    <label><span class="label-item">Альтернативное название:</span><input type="text" placeholder="Альтернативное название"></label>
    <label><span class="label-item">Сезон:</span><input type="text" placeholder="Сезон"></label>
    <label><span class="label-item">Картинка:</span><input type="text" placeholder="Картинка"></label>
    <label><span class="label-item">Жанр:</span>
      <select data-placeholder="Выбирите категорию" class="chosen-select" multiple tabindex="4">
        <option value=""></option>
        <option value="United States">United States</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Aland Islands">Aland Islands</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="American Samoa">American Samoa</option>
        <option value="Andorra">Andorra</option>
      </select>
  </label>
    
      
    <label><span class="label-item">Год выпуска:</span><input type="text" placeholder="Год выпуска"></label>
    <label><span class="label-item">Описание:</span><textarea placeholder="Описание"></textarea></label>

    <input type="button" name="save" value="Сохранить">
  </form>
</div>

