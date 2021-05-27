<link rel="stylesheet" href="<?= $uri ?>/templates/dashboard/css/parse.css">
<link rel="stylesheet" href="<?=$uri?>/templates/css/search.css?<?=filemtime('templates/css/search.css')?>">
<style>
    .search-name:hover{
        cursor: pointer;
        background: #2E59D9;
        color: white;
    }
</style>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Страница парсинга</h1>

    <div class="parse-parent">
        <div class="parse-item">
            <div class="parse-item-header">Парсинг аниме</div>
            <div class="parse-item-body">
                <div class="parse-inputs-top">
                    <select name="site" id="site">
                        <option value="1">Mix.tj</option>
                        <option value="2">Topvideo.tj</option>
                    </select>

                    <input type="search" placeholder="Поиск" id="titleForParse">
                </div>

                <div class="parse-inputs-bottom">
                    <input type="number" id="startPage" placeholder="Начало страницы">
                    <input type="number" id="endPage" placeholder="Конец страницы">
                    <input type="number" id="startVideo" placeholder="Начало видео">
                    <input type="number" id="endVideo" placeholder="Конец видео">
                </div>

                <div class="parse-button">
                    <button type="button" id="startParse"><i class="fas fa-search fa-sm"></i></button>
                </div>
            </div>
        </div>


        <div class="parse-item">
            <div class="parse-item-header">Парсинг аниме по каналу</div>
            <div class="parse-item-body">
                <div class="parse-inputs-top">
                    <select class="" id="channel">
                        <option selected disabled>Каналы</option>
                        <?php foreach ($channels as $channel) :?>
                        <option value="<?=$channel['title']?>"><?=$channel['title']?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="search" placeholder="Поиск" id="titleParseChannel">
                </div>

                <div class="parse-inputs-bottom">
                    <input type="number" id="startPageCh" placeholder="Начало страницы">
                    <input type="number" id="endPageCh" placeholder="Конец страницы">
                    <input type="number" id="startVideoCh" placeholder="Начало видео">
                    <input type="number" id="endVideoCh" placeholder="Конец видео">
                </div>

                <div class="parse-button">
                    <button type="button" id="parseChannel"><i class="fas fa-search fa-sm"></i></button>
                </div>
            </div>
        </div>

        <div class="parse-item full-width">
            <div class="parse-item-header">Сортировка аниме</div>
            <div class="parse-item-body parse-item-body-search">
                <input type="search" placeholder="Аниме для сортировки" id="titleForSort">
                <div class="parse-button">
                    <button type="button" id="btnForSort"><i class="fas fa-search fa-sm"></i></button>
                </div>
            </div>
        </div>

        <div class="parse-item parse-item-main full-width">
            <div class="parse-item-header">Сортировка серии</div>
            <div class="parse-item-body">
                <input type="text" class="search" id="titleForSave" placeholder="Название аниме">
<!--                ajax-->
                <div class="cross ">
                    <div class="cross-line"></div>
                    <div class="cross-line"></div>
                </div>

                <div class="loader"></div>

                <div class="back-search">
                    <i class="fa fa-reply-all"></i>
                </div>
                <div class="show-all-search">Показать все</div>
                <div class="ajax-search" style="max-width: 70%"></div>
<!--                ajax-->
                <div class="parse-inputs-top">
                    <div class="">Серия Cезон/Категория Оригинальное название</div>
                </div>
                <input type="search" placeholder="Аниме для сортировки" name="rlyTitle" id="rlyTitle" hidden>
                <form name="sortForm" action="#" id="sortForm">

                <ul class="parse-inputs-bottom" id="formSort">



                </ul>

                <div class="parse-button">
                    <button type="button" id="save">Сохранить</button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script src="<?= $uri ?>/templates/dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?= $uri ?>/templates/dashboard/js/parse.js?<?= filemtime('templates/dashboard/js/parse.js') ?>"></script>
<script src="<?= $uri ?>/templates/dashboard/js/parsing.js?<?=filemtime('templates/dashboard/js/parsing.js') ?>"></script>
<script src="<?=$uri?>/templates/dashboard/js/search.js?<?=filemtime('templates/dashboard/js/search.js')?>"></script>

