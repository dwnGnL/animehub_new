<?=$slider?>
<!-- Content -->
<div id="content">

  <!-- поиск -->
  <?=$search?>
    
    <?php
    $url = '/anime';
    $title = 'Новые серии аниме';
    $url_title = 'Смотреть все новинки';
    include 'blocks/cards.block.php'
    ?>

    <?php
    $url = '/anime';
    $title = 'Все аниме';
    $url_title = 'Смотреть все';
    $posts = $newPosts;
    include 'blocks/cards.block.php'
    ?>

    <?php
    $url = '/dorams';
    $title = 'Все дорамы';
    $url_title = 'Смотреть все';
    $posts = $dorams;
    include 'blocks/cards.block.php'
    ?>
</div>

<script src="<?=$uri?>/templates/js/slider.js?<?=filemtime('templates/js/slider.js')?>"></script>
