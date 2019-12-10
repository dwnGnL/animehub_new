<style>
    @media screen and (min-width: 992px) {
        #menu > li:nth-child(1) {
            background: #D81C27;
            cursor: pointer;
        }

        #menu > li:nth-child(1) a  span {
            color: #fff !important;
        }
    }
</style>
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

<div id="film-list-content">
    <div class="all-anime-list-block">
        <div class="head">
            <div class="left-head"><?=$title?></div>
        </div>

        <div class="films">
            <?php if(isset($items) && is_array($items)): ?>
            <?php foreach ($items as $item): ?>
            <div class="film-item">
                <a href="<?=$uri.$item['title_type_post']?>/<?=$helper::renderUrl($item['id'],$item['alias'])?>">
                <div class="background-film-item">
                    <img src="<?=$item['image']?>">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review"><?=$item['views']?></span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>
                </a>
                <div class="discription">
                    <div class="film-name"><a href="<?=$uri.$item['title_type_post']?>/<?=$helper::renderUrl($item['id'],$item['alias'])?>"><?=$item['title'].' '.$item['tv_title']?></a></div>
                    <div class="film-gener"><?=$helper::renderCat($item['cats'])?></div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>

    <?=$navigation?>
</div>

