<link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/parse.css">

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Страница парсинга</h1>

  <div class="parse-parent">
    <div class="parse-item">
      <div class="parse-item-header">Парсинг аниме</div>
      <div class="parse-item-body">
        <div class="parse-inputs-top">
          <select class="">
            <option value="Mix.tj">Mix.tj</option>
            <option value="Topvideo.tj">Topvideo.tj</option>
          </select>

          <input type="text" placeholder="Search">
        </div>

        <div class="parse-inputs-bottom">
          <input type="number" placeholder="Начало страницы">
          <input type="number" placeholder="Search">
          <input type="number" placeholder="Search">
          <input type="number" placeholder="Search">
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

          <input type="text" placeholder="Search">
        </div>

        <div class="parse-inputs-bottom">
          <input type="number" placeholder="Начало страницы">
          <input type="number" placeholder="Search">
          <input type="number" placeholder="Search">
          <input type="number" placeholder="Search">
        </div>

        <div class="parse-button"><button type="button"><i class="fas fa-search fa-sm"></i></button></div>

      </div>
    </div>
  </div>
</div>
