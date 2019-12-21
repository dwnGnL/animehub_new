<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <h4 class="">Парсинг аниме</h4>
        <div class="card mb-4 wow fadeIn" style="display: inline-block;width: 100%;">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1" id="otvet">
                </h4>


                    <img src="../img/gif/Load.gif" id="load" class="invisible" alt="#">
                        <select name="site" class="form-control" id="Select" style="width:15%;height: 53px;">
                          <option value="1">Mix.tj</option>
                          <option value="2">Topvideo.tj</option>
                        </select>
                    <input type="search" name="search" class="form-control" id="titleAnime" placeholder="Поиск" style="width:70%;">
                    <button id="send" class="btn btn-primary btn-sm my-0 p" name="btn">►</button>

            </div>
            <textarea name="" id="" class="form-control" rows="5" placeholder="Отправить уведомление"></textarea>
            <button type="button" class="btn btn-primary" style="float:right;">Confirm</button>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <h4 class="">Парсинг аниме по каналу</h4>
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1" id="otvetChannel">
                </h4>


                <img src="../img/gif/Load.gif" id="loadChannel" class="invisible" alt="#">
                <input type="search" name="search" class="form-control" id="titleAnimeChannel"  placeholder="Поиск" style="width:40%;">
                <select name="Users" id="" class="form-control mx-5 " style="width:25%;">
                    <?php
                    require 'lib/Model.php';
                    $model = new Model();
                    $channel = $model->getChannel();
                    ?>
                    <option value="" disabled>Канал</option>
                    <?php foreach ($channel as $value){ ?>
                    <option id="<?=$value['id'];?>" value="<?=$value['title'];?>"><?=$value['title'];?></option>
                    <?php }?>

                </select>

                <button id="searchChannel" class="btn btn-primary  float-right ml-0" name="btn">►</button>

            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <h4>Сортировка аниме</h4>
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1" id="crest">

                </h4>


                <input type="search" name="search" class="form-control" id="titleAnimeForSort" placeholder="Аниме для сортировки">
                <button id="kalbosa" class="btn btn-primary btn-sm my-0 p" name="btn">►</button>


            </div>
        </div>
    </div>
    <div class="container-fluid">

    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
    </form>


    <form action="" method="post" name="formSort" id="formSort">
        <span ><img src="../img/gif/Load.gif" id="waitOver" class="invisible" alt="#"></span>
        <input id="animeTitle" type="text" class="name form-control mr-sm-2" name="titleAnime" placeholder="Название аниме">
        <input id="rlyTitle" type="text" class="name form-control mr-sm-2 " name="rlyTitle" placeholder="Название аниме" hidden>
        <div class="form-inline">
            <input id="lengthSer" type="text" class="one form-control mr-sm-2" name="lengthSer" >
            <input id="login" type="text" class="one form-control mr-sm-2" name="login" value="<?=$_SESSION['login'];?>" >
        </div>
        <span>Серия</span>
        <span>Cезон/Категория</span>
        <span>Оригинальное название</span>
        <div class="container-fluid" id="formContent">
            <div class="container" id="formInput">


            </div>
        </div>
        <input type="button" id="btnSort" class="btn btn-primary my-2 mr-sm-0 waves-effect" value="Сохранить">
    </form>
            </div>
        </div>
    </div>

        <div id="script"></div>

</main>