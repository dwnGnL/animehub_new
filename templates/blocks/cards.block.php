<div class="all-anime-block">
    <div class="head">
        <div class="left-head"><?=$title?></div>
        <a href="<?=$url?>"><div class="right-head"><?=$url_title?></div></a>
    </div>

    <div class="films">
        <?php foreach ($posts as $post): ?>
            <?php include 'card.block.php'?>
        <?php endforeach; ?>
    </div>
</div>
