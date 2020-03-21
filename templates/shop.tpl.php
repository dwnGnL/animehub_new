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
    .ribbon {
        left: 17px;
    }
</style>


<div id="film-list-content">
    <?=$search?>
    <div class="all-anime-list-block">
        <div class="head">
            <div class="left-head">Магазин Animehub</div>
        </div>

        <div class="films">
            <?php if(isset($products) && is_array($products)): ?>
                <?php foreach ($products as $item): ?>
                    <div class="film-item">
                        <a href="/shop/product/<?=$helper::renderUrl($item['id_product'],$item['name_product'])?>">
                            <div class="background-film-item">
                                <img src="<?=$uri.$item['img_product']?>">
                                <div class="over-back-film-item">

                                </div>
                            </div>
                        </a>
                        <div class="discription">
                            <div class="film-name"><a href="<?=$uri?>.'shop/'.<?=$helper::renderUrl($item['id_product'],$item['name_product'])?>"><?=$item['name_product']?></a></div>
                            <div class="film-gener"><?=$item['cat_name']?></div>
                            <div class="buy-info"><a href="/shop/product/<?=$helper::renderUrl($item['id_product'],$item['name_product'])?>" class="btn-buy"><?=$item['price_product']?>с</a></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

    </div>

    <?=$navigation?>
</div>


