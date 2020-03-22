<link rel="stylesheet" href="<?=$uri?>/templates/css/search.css?<?=filemtime('templates/css/search.css')?>">
<input type="text" value="<?=$type?>" id="type" hidden>
<form class="search-block" action="/search" method="get">
    <input type="text" name="do" class="search">
    <div class="placeholder">Поиск аниме</div>

    <div class="cross">
        <div class="cross-line"></div>
        <div class="cross-line"></div>
    </div>

    <div class="loader"></div>

    <div class="back-search">
      <i class="fa fa-reply-all"></i>
    </div>
    <div class="show-all-search">Показать все</div>
    <div class="ajax-search"></div>

</form>
<script src="<?=$uri?>/templates/js/search.js?<?=filemtime('templates/js/search.js')?>"></script>
