<nav aria-label="page navigation" class="navigation">
    <ul class="pagination justify-content-center">
        <link rel="stylesheet" href="css/animehub2.css">
        <li class="page-item <?=$disabled;?>">
            <a class="page-link bg-light" href="<?=$href;?><?= $_GET['page'] - 1; ?>" tabindex="-1">Previous</a>
        </li>
        <li class="page-item "><a class="page-link page-number <?=$active;?>" href="<?=$hrefNumb;?><?=1?>">1</a></li>
        <?php
        if(isset($_GET['page']) && $_GET['page'] > 4){
            $start = $_GET['page'] - 4;
            if($pageCount - $_GET['page'] < 4){
                $start = $pageCount - 8;
            }
        }else{
            $start = 0;
        }

        if(isset($_GET['page']) && $pageCount - $_GET['page'] > 4){
            $end = $_GET['page'] + 4;
            if(($_GET['page'] < 4)){
                $end = 8;
            }
        }elseif (isset($_GET['page'])){
            $end = $pageCount;

        }
        elseif($pageCount == 1){
            $active = 'disabled';
        }elseif(ceil($pageCount) < 9){
            $end = $pageCount;
        }else{
            $end = 8;
        }

        $pageCount = ceil($pageCount);
        ?>
        <?php for($i = 1 + $start ; $i < $end - 1; $i++) {?>
            <?php
            if($i + 1 == $_GET['page']) {
                $active = 'bg-primary';
            } else{
                $active = '';
            }

            ?>

            <li class="page-item "><a class="page-link page-number <?=$active;?>" href="<?=$hrefNumb;?><?=$i + 1?>"><?= $i + 1 ?></a></li>

        <?php }
        if(isset($_GET['page']) && $_GET['page'] == $pageCount){
            $disabledEnd = 'disabled';
            $active = 'bg-primary';
        }else{
            $disabled = '';
            $active = '';

        }
        if(isset($_GET['page'])){
            $pageBlink = 1;
        }else{
            $disabled = 'disabled';
            $pageBlink = 2;
        }
        if($pageCount > 1){
            ?>
            <li class="page-item "><a class="page-link <?=$active;?>" href="<?=$hrefNumb;?><?=$pageCount;?>"><?=$pageCount;?></a></li>
        <?php }else{
            $disabledEnd = 'disabled';
        } ?>
        <li class="page-item <?=$disabledEnd;?>">
            <a class="page-link bg-light" href="<?=$href?><?=$_GET['page']+$pageBlink?>">Next</a>
        </li>

    </ul>
</nav>
