
<link rel="stylesheet" href="<?=$uri?>/templates/css/slider.css">

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

<div id="slider">
    <div class="arrows">
        <div class="arrow-item s-next"><img src="<?=$uri?>/templates/images/arrow.png" alt=""> </div>
        <div class="arrow-item s-prev"><img src="<?=$uri?>/templates/images/arrow.png" alt=""> </div>
    </div>

    <div class="background-slider"></div>

    <div class="slide-wrapper">
        <div class="slide"><img src="<?=$uri?>/templates/images/Dr_Stone_Banner.png"> </div>
        <div class="slide"><img src="<?=$uri?>/templates/images/Fire_Force.png"> </div>
        <div class="slide"><img src="<?=$uri?>/templates/images/klinok.png"> </div>
        <div class="slide"><img src="<?=$uri?>/templates/images/Vinland-Banner.png"> </div>
    </div>
</div>

<!-- Content -->
<div id="content">
    <form class="search-block" action="index.html" method="post">
        <input type="text" class="search" placeholder="Поиск аниме...">
        <input type="button" value="Подобрать">
    </form>

    <!-- New series -->
    <div class="new-series-block">
        <div class="head">
            <div class="left-head">Новые серии аниме</div>
            <div class="right-head">Смотреть все новинки</div>
        </div>

        <div class="films">
            <?php if (isset($items) && is_array($items)):?>
            <?php foreach ($items as $item):?>
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

    <!-- All of anime -->
    <div class="all-anime-block">
        <div class="head">
            <div class="left-head">Все аниме</div>
            <div class="right-head">Смотреть все новинки</div>
        </div>

        <div class="films">
            <div class="film-item">
                <div class="background-film-item">
                    <img src="images/image (1).jpg">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review">15 423</span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>

                <div class="discription">
                    <div class="film-name">Название sdsadsd фильма</div>
                    <div class="film-gener">Жанр фильма</div>
                </div>
            </div>

            <div class="film-item">
                <div class="background-film-item">
                    <img src="images/image (2).jpg">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review">15 423</span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>

                <div class="discription">
                    <div class="film-name">Название sdsadsd фильма</div>
                    <div class="film-gener">Жанр фильма</div>
                </div>
            </div>

            <div class="film-item">
                <div class="background-film-item">
                    <img src="images/image (3).jpg">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review">15 423</span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>

                <div class="discription">
                    <div class="film-name">Название sdsadsd фильма</div>
                    <div class="film-gener">Жанр фильма</div>
                </div>
            </div>

            <div class="film-item">
                <div class="background-film-item">
                    <img src="images/image (4).jpg">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review">15 423</span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>

                <div class="discription">
                    <div class="film-name">Название sdsadsd фильма</div>
                    <div class="film-gener">Жанр фильма</div>
                </div>
            </div>

            <div class="film-item">
                <div class="background-film-item">
                    <img src="images/image (5).jpg">
                    <div class="over-back-film-item">
                        <div class="circle">
                            <span class="review">15 423</span>
                            <span>Просмотров</span>
                        </div>
                    </div>
                </div>

                <div class="discription">
                    <div class="film-name">Название sdsadsd фильма</div>
                    <div class="film-gener">Жанр фильма</div>
                </div>
            </div>
        </div>
    </div>

    <!-- News -->
    <div class="news-block">
        <div class="head">
            <div class="left-head">Свежие статьи и новости</div>
            <div class="right-head">Читать все</div>
        </div>

        <div class="news">
            <div class="news-item">
                <div class="background-news">
                    <img src="images/image (1).jpg">
                </div>

                <div class="right-block">
                    <div class="news-discription">Стань киберспортсменом!</div>
                    <div class="date">Статьи и Новости, 11.08.19</div>
                </div>
            </div>

            <div class="news-item">
                <div class="background-news">
                    <img src="images/image (1).jpg">
                </div>

                <div class="right-block">
                    <div class="news-discription">Стань киберспортсменом!</div>
                    <div class="date">Статьи и Новости, 11.08.19</div>
                </div>
            </div>

            <div class="news-item">
                <div class="background-news">
                    <img src="images/image (1).jpg">
                </div>

                <div class="right-block">
                    <div class="news-discription">Стань киберспортсменом!</div>
                    <div class="date">Статьи и Новости, 11.08.19</div>
                </div>
            </div>

            <div class="news-item">
                <div class="background-news">
                    <img src="images/image (1).jpg">
                </div>

                <div class="right-block">
                    <div class="news-discription">Стань киберспортсменом!</div>
                    <div class="date">Статьи и Новости, 11.08.19</div>
                </div>
            </div>

            <div class="news-item">
                <div class="background-news">
                    <img src="images/image (1).jpg">
                </div>

                <div class="right-block">
                    <div class="news-discription">Стань киберспортсменом!</div>
                    <div class="date">Статьи и Новости, 11.08.19</div>
                </div>
            </div>

            <div class="news-item">
                <div class="background-news">
                    <img src="images/image (1).jpg">
                </div>

                <div class="right-block">
                    <div class="news-discription">Бан нашей группы Вконтакте. Подписывайтесь на резервную!</div>
                    <div class="date">Статьи и Новости, 11.08.19</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=$uri?>/templates/js/slider.js"></script>
