<link rel="stylesheet" href="<?=$uri?>/templates/css/slider.css?<?=filemtime('templates/css/slider.css')?>">

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
        <div class="arrow-item s-next">
          <i class="fa fa-angle-double-right"></i>
        </div>

        <div class="arrow-item s-prev">
          <i class="fa fa-angle-double-left"></i>
        </div>
    </div>

    <div class="background-slider"></div>

    <div class="slide-wrapper">
        <?php foreach ($slider as $slide):?>
            <a href="/anime/<?=$helper::renderUrl($slide['id'], $slide['alias'])?>" >  <div class="slide"><img src="<?=$slide['img']?>"> </div></a>
        <?php endforeach; ?>
    </div>
</div>
