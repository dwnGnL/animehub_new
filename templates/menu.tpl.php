

    <div id="profile">
        <div class="top">
            <div>Profile name</div>
            <div class="exit-profile">
                <div class="exit-line f-line"></div>
                <div class="exit-line s-line"></div>
            </div>
        </div>

        <div class="main-sign-in-page">
            <div class="profile-data">
                <div class="profile-avatar">
                    <img src="<?=$uri?>/templates/images/image (1).jpg" alt="">
                </div>

                <div class="profile-name">
                    <?=$_SESSION['login']?>
                </div>
            </div>

            <div class="profile-bottom">
                <div><a href="<?=$uri?>/templates/index.php?profile">Профиль</a></div>
                <div>Закладки: (<span class="bookmark-quantity">0</span>)</div>
                <div><a href="<?=$app->urlFor('logout')?>">Выйти</a> </div>
            </div>
        </div>
    </div>


    <div id="header">
    <a href="<?=$app->urlFor('home')?>">
    <div class="logo main-logo">
        <img class="logo-img" src="<?=$uri?>/templates/images/logo.png">
    </div>
    </a>
    <ul id="menu">
        <li class="active sub-menu top-menu">
            <a href="/anime"><span>Аниме</span></a>
            <div id="sub-menu">
                <div class="left-part-sub-menu">
                    <span class="sub-menu-header">По типу</span>
                    <ul class="qualification-list">
                        <li>Запад</li>
                        <li>ТВ</li>
                        <li>OVA</li>
                        <li>Фильм</li>
                        <li>ONA</li>
                    </ul>

                    <span class="sub-menu-header">По годам</span>
                    <ul class="qualification-list">
                        <li>2019</li>
                        <li>2018</li>
                        <li>2017</li>
                        <li>2016</li>
                        <li>2015</li>
                        <li>2014</li>
                        <li>2013</li>
                        <li>2012</li>
                        <li>2011</li>
                        <li>2010</li>
                        <li>2009</li>
                        <li>2008</li>
                        <li>2007</li>
                        <li>2006</li>
                        <li>2005</li>
                        <li>2004</li>
                        <li>2003</li>
                        <li>2002</li>
                        <li>2001</li>
                        <li>2000</li>
                        <li>1999</li>
                        <li>1998</li>
                    </ul>
                </div>

                <ul class="middle-part-sub-menu gener-list">
                    <?php if (isset($categories) && is_array($categories)): ?>
                    <?php $i = 0; ?>
                    <?php foreach ($categories as $category ): ?>

                    <?php if ($i != 25): ?>
                        <li><?=$category['title']?></li>
                    <?php elseif($i == 25): ?>
                </ul>
                <ul class="right-part-sub-menu gener-list">
                        <li><?=$category['title']?></li>
                    <?php else:  ?>
                        <li><?=$category['title']?></li>
                    <?php endif;  ?>
                    <?php $i++?>
                    <?php endforeach;  ?>
                    <?php endif;  ?>
                </ul>
            </div>
        </li>
        <?php if (!empty($pages) && is_array($pages)): ?>
        <?php foreach ($pages as $page): ?>
        <li class="top-menu"><a href="<?=$app->urlFor('page',['alias' => $page['alias']])?>"><span><?=$page['title']?></span></a></li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>


    <?php if (!isset($_SESSION['auth'])):?>
    <div id="sign-in-button">Войти</div>
    <?php else: ?>
    <div id="profile-button">Профиль</div>
    <?php endif; ?>
    <div id="menu-button">
        <div class="menu-lines">
            <div class="menu-line l1"></div>
            <div class="menu-line l2"></div>
            <div class="menu-line l3"></div>
        </div>
    </div>
</div>
