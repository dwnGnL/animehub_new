<link rel="stylesheet" href="<?=$uri?>/templates/css/film-page.css">
<script type="text/javascript" src="<?=$uri?>/templates/Admin/js/ckeditor/ckeditor.js"></script>

<div id="film-content">
    <div class="film-discription-block">
        <div class="img-film-discription">
            <img src="<?=$post['image']?>">
        </div>

        <div class="film-discription">
            <div class="film-discription-header"><?=$post['title']?></div>
            <div class="film-discription-header-translate"><?=$post['alias']?></div>

            <ul class="distinctio-list">
                <li>
                    <span class="distinctio-list-left">Жанры:</span>
                    <span class="distinctio-list-right"><?=$cat?></span>

                </li>
                <li>
                    <span class="distinctio-list-left">Год:</span>
                    <span class="distinctio-list-right"><?=$post['god']?></span>
                </li>

                <li>
                    <span class="distinctio-list-left">Автор:</span>
                    <span class="distinctio-list-right"><?=$post['login']?></span>
                </li>
                <li>
                    <span class="distinctio-list-left">День выхода:</span>
                    <span class="distinctio-list-right">Воскресение</span>
                </li>

                <li class="review-order">
                    <span>Порядок просмотра:</span>
                    <ol class="review-order-list">
                        <li><a href="#">Tv-1</a></li>
                        <li><a href="#">Tv-1</a></li>
                        <li><a href="#">Tv-1</a></li>
                        <li><a href="#">Tv-1</a></li>
                    </ol>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-discription">
        <div class="discription-header">Описание <span>аниме</span> <span>«<?=$post['title']?>»</span></div>

        <div class="discription-text">
            <?=$post['body']?>
        </div>

        <div class="show-all-text">Развернуть</div>
    </div>

    <!-- ____________________________ -->
    <div class="top-video-block">
        <div class="search-series-input">
            <input id="search-input" type="text" placeholder="Поиск серии">
            <div class="start-search">Поиск</div>
        </div>

        <div class="arrow-series to-left-series"><div></div></div>

        <div class="series-block">
            <ul class="series-list">
                <li class="series-item series-item-active"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
                <li class="series-item"><span class="series-number"></span> серия</li>
            </ul>
        </div>

        <div class="arrow-series to-right-series"><div></div></div>
        <div class="search-series"><img src="<?=$uri?>/templates/images/search.png"></div>
    </div>

    <!-- ____________________________ -->

    <video src="videos/DEEP SPACE INDUSTRIES (DSI).mp4" controls></video>

    <div class="all-anime-block">
        <div class="head">
            <div class="left-head">Смотрите также</div>
        </div>

        <div class="films">
            <div class="film-item">
                <div class="background-film-item">
                    <img src="<?=$uri?>/templates/images/image (1).jpg">
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
                    <img src="<?=$uri?>/templates/images/image (2).jpg">
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
                    <img src="<?=$uri?>/templates/images/image (3).jpg">
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
                    <img src="<?=$uri?>/templates/images/image (4).jpg">
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
                    <img src="<?=$uri?>/templates/images/image (5).jpg">
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

    <!-- <table cellspacing="0">
      <caption>Ван пис</caption>
      <thead>
        <tr>
          <th>Номер серии</th>
          <th>Название</th>
          <th>Дата выхода оригинала</th>
          <th>Дата релиза</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>какая-та серия</td>
          <td> какое-то название</td>
          <td>какая-та дата</td>
          <td>какая-та дата</td>
        </tr>

        <tr>
          <td>какая-та серия</td>
          <td> какое-то название</td>
          <td>какая-та дата</td>
          <td>какая-та дата</td>
        </tr>

        <tr>
          <td>какая-та серия</td>
          <td> какое-то название</td>
          <td>какая-та дата</td>
          <td>какая-та дата</td>
        </tr>

        <tr>
          <td>какая-та серия</td>
          <td> какое-то название</td>
          <td>какая-та дата</td>
          <td>какая-та дата</td>
        </tr>

        <tr>
          <td>какая-та серия</td>
          <td> какое-то название</td>
          <td>какая-та дата</td>
          <td>какая-та дата</td>
        </tr>

        <tr>
          <td>какая-та серия</td>
          <td> какое-то название</td>
          <td>какая-та дата</td>
          <td>какая-та дата</td>
        </tr>
      </tbody>
    </table> -->


    <div class="video-comments-block">
        <div class="head">
            <div class="left-head">Комментарии</div>
        </div>

        <!--Коментарий-->
        <form class="form-comment form">
            <!-- <textarea class="form-control" name="comment"  id="textComment" cols="80" rows="10" placeholder="Оставить коментарий..." ></textarea> -->
            <!-- <textarea id="textComment" name="comment" class="form-control" placeholder="Оставить коментарий..."></textarea> -->
            <button class="btn btn-outline-secondary" type="button" id="sendComment">Оставить комментарий</button>
        </form>


        <script type="<?=$uri?>/templates/text/javascript">
            // var config1 = {
            //   height:'200',
            //   startupOutlineBlocks:true,
            //   scayt_autoStartup:true,
            //   toolbar:[
            //
            //     { name: 'insert', items : [ 'Smiley' ] }
            //   ]
            // }
            // CKEDITOR.replace('textComment',config1);
            var config2 = {
                height:'200',
                startupOutlineBlocks:true,
                startupFocus : true,
                scayt_autoStartup:true,
                toolbar: [
                    { name: 'insert', items : [ 'HKemoji' ] }
                ]
            }

            CKEDITOR.replace('textComment', config2);
        </script>

        <div class="video-comments">
            <div class="video-comment-item">
                <div class="video-comment-user-avatar">
                    <img src="<?=$uri?>/templates/images/image (1).jpg">
                </div>

                <div class="video-comment-right">
                    <div class="comment-arrow"></div>

                    <div class="top-video-comment-item">
                        <div class="video-comment-user-name">
                            Тут имя
                        </div>
                        <div class="video-comment-date">
                            1 ноября 2019 16:00f
                        </div>
                    </div>

                    <div class="video-comment-text">
                        Здравствуйте. Подскажите, когда выйдет следующая серия?
                        И почему у организации занимающейся, считай,
                        благотворительным переводом мультсериалов не указаны
                        реквизиты, для добровольных пожертвований?
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=$uri?>/templates/js/show-hide-text.js"></script>
<script src="<?=$uri?>/templates/js/video.js"></script>

