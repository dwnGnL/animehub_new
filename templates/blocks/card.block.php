<div class="film-item">
    <a href="<?=$url?>/<?=$helper::renderUrl($post->id, $post->alias)?>">
        <div class="background-film-item">
            <img src="<?=$post->image?>" alt="<?=$post->title.' '.$post->tv->title?>">
            <div class="over-back-film-item">
                <div class="circle">
                    <span class="review"><?=$post->view->views?></span>
                    <span>Просмотров</span>
                </div>
            </div>
        </div>
        <div class="ribbon"><?=$post->anime->seria?></div>
    </a>
    <div class="discription">
        <div class="film-name"><a href="<?=$url?>/<?=$helper::renderUrl($post->id, $post->alias)?>"><?=$post->title.' '.$post->tv->title?></a></div>
        <div class="film-gener"><?=$helper::renderCat($post->categories)?></div>
    </div>
</div>
