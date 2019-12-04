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

<div id="film-list-content">
    <div class="all-anime-list-block">
        <div class="head">
            <div class="left-head">Новые серии аниме</div>
        </div>

        <div class="films">
            <?php if(isset($items) && is_array($items)): ?>
            <?php foreach ($items as $item): ?>
            <div class="film-item">
                <div class="background-film-item">
                    <img src="<?=$item['image']?>">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review"><?=$item['views']?></span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>

                <div class="discription">
                    <div class="film-name"><?=$item['title'].' '.$item['tv_title']?></div>
                    <div class="film-gener">Жанр фильма</div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>

    <?=$navigation?>
</div>

