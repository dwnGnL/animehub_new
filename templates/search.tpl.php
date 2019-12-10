<link rel="stylesheet" href="<?=$uri?>/templates/css/search.css?<?=filemtime('templates/css/search.css')?>">
<form class="search-block" action="index.html" method="post">
    <input type="text" class="search" placeholder="Поиск аниме...">

    <div class="cross">
        <div class="cross-line"></div>
        <div class="cross-line"></div>
    </div>
    <div class="loader"></div>

    <input type="button" value="Подобрать">
    <div class="ajax-search">
        <div class="ajax-block">
            <div class="search-name">afasdfa</div>
            <div class="search-img"><img src="<?=$uri?>/templates/images/image (1).jpg"> </div>
        </div>

        <div class="ajax-block">
            <div class="search-name">gdgadsf</div>
            <div class="search-img"><img src="<?=$uri?>/templates/images/image (1).jpg"> </div>
        </div>

    </div>
</form>
<script src="<?=$uri?>/templates/js/search.js"></script>