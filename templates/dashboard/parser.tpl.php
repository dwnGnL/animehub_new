<link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/parse.css">

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Страница парсинга</h1>

  <div class="parse-parent">
    <div class="parse-item">
      <div class="parse-item-header">Парсинг аниме</div>
      <div class="parse-item-body">
        <div class="parse-inputs-top">
          <select>
            <option value="Mix.tj">Mix.tj</option>
            <option value="Topvideo.tj">Topvideo.tj</option>
          </select>

          <input type="text" placeholder="Поиск">
        </div>

        <div class="parse-inputs-bottom">
          <input type="number" placeholder="Начало страницы">
          <input type="number" placeholder="Конец страницы">
          <input type="number" placeholder="Начало видео">
          <input type="number" placeholder="Конец видео">
        </div>

        <div class="parse-button"><button type="button"><i class="fas fa-search fa-sm"></i></button></div>
      </div>
    </div>


    <div class="parse-item">
      <div class="parse-item-header">Парсинг аниме по каналу</div>
      <div class="parse-item-body">
        <div class="parse-inputs-top">
          <select class="" >
            <option selected disabled>Каналы</option>
            <option value="Mix.tj">Mix.tj</option>
            <option value="Topvideo.tj">Topvideo.tj</option>
          </select>

          <input type="text" placeholder="Поиск">
        </div>

        <div class="parse-inputs-bottom">
          <input type="number" placeholder="Начало страницы">
          <input type="number" placeholder="Конец страницы">
          <input type="number" placeholder="Начало видео">
          <input type="number" placeholder="Конец видео">
        </div>

        <div class="parse-button"><button type="button"><i class="fas fa-search fa-sm"></i></button></div>
      </div>
    </div>

    <div class="parse-item full-width">
      <div class="parse-item-header">Сортировка аниме</div>
      <div class="parse-item-body parse-item-body-search">
        <input type="text" placeholder="Аниме для сортировки">
        <div class="parse-button"><button type="button"><i class="fas fa-search fa-sm"></i></button></div>
      </div>
    </div>

    <div class="parse-item parse-item-main full-width">
      <div class="parse-item-header">Парсинг аниме по каналу</div>
      <div class="parse-item-body">
        <div class="parse-inputs-top">
          <input type="text" placeholder="Название аниме">
          <input type="text" placeholder="">
          <input type="text" placeholder="">

          <div class="">Серия Cезон/Категория Оригинальное название</div>
        </div>

        <ul class="parse-inputs-bottom">
          <li class="parse-inputs-bottom-item">
            <input type="text">
            <input class="parse-anime-name" type="text">
            <textarea></textarea>
            <button class=""><i class="fa fa-trash"></i></button>
          </li>

          <li class="parse-inputs-bottom-item">
            <input type="text">
            <input class="parse-anime-name" type="text">
            <textarea></textarea>
            <button class=""><i class="fa fa-trash"></i></button>
          </li>

          <li class="parse-inputs-bottom-item">
            <input type="text">
            <input class="parse-anime-name" type="text">
            <textarea></textarea>
            <button class=""><i class="fa fa-trash"></i></button>
          </li>

          <li class="parse-inputs-bottom-item">
            <input type="text">
            <input class="parse-anime-name" type="text">
            <textarea></textarea>
            <button class=""><i class="fa fa-trash"></i></button>
          </li>
        </ul>

        <input type="text" placeholder="Причина обновления">
        <div class="parse-button"><button type="button">Сохранить</button></div>
      </div>
    </div>

  </div>
</div>

<script src="<?=$uri?>/templates/dashboard/js/parsing.js"></script>
