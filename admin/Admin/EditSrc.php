

<style>

    form,.one_obj{

        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);

        margin: 5px;

        margin-bottom: 10px;
        
        font-size:0;
    }

    form{

        padding: 15px;

    }

    form input{

        width: 5%;

        height:5%;

        font-size: 12px;

        background-color: white;

    }



    input.kach{

        width: 6%;

    }



    form input:nth-child(2){

        width:15%;

    }



    input.src{

        width: 30%;

    }

    input.mix_title{

        width: 22%;

    }



    .input_name{

        padding: 5px;

    }

    .input_name span{

        margin-right: 3.9%;

    }

    .input_name span:nth-child(6){

        margin-right: 2%;

    }

    .input_name .src{

        margin-right: 33%;

    }

</style>



<main class="pt-5 mx-lg-5">

    <div class="container-fluid mt-5">

        <div class="card mb-4 wow fadeIn">

            <div class="card-body d-sm-flex justify-content-between">





                <input type="search" name="search" class="form-control" id="titleAnimeSrc" placeholder="Название аниме">
                <input type="search" name="search" class="form-control" id="tvAnimeSrc" placeholder="Сезон">

                <button id="findTitleAnimeSrc" class="btn btn-primary btn-sm my-0 p" name="btn"><i class="fa fa-search" aria-hidden="true"></i></button>



            </div>

        </div>

    </div>

    <form id="formChangeSrc" style="background: white">

        <div class="inputView">
            <?php if(isset($_GET['anime_title']) && isset($_GET['anime_tv'])) {
                require_once 'lib/Model.php';
                $model = new Model();
                $count = $model->getCountForChangeSrcTv($_GET['anime_title'],$_GET['anime_tv']);
            }?>




            <input type="text" name="inputСount" id="inputСount" value="<?=$count['COUNT(*)'];?>">

            <?php if(isset($_GET['anime_title']) && isset($_GET['anime_tv'])) {?>
            <?php


                $anime =  $model->getAllPostForChangeSrcTv($_GET['anime_title'], $_GET['anime_tv']);
                foreach ($anime as $value){
                ?>
            <div class="one_obj">

                <input class="count" type="text" name="id<?=$value['id'];?>"  value="<?=$value['id'];?>">

            <input type="text" name="title<?=$value['id'];?>"  value="<?=$value['title'];?>">

                <input type="text" class="src" name="src<?=$value['id'];?>"  value="<?=$value['src'];?>">

                <input  type="text" name="tv<?=$value['id'];?>"  value="<?=$value['tv'];?>">

               <input type="text" name="ser<?=$value['id'];?>"  value="<?=$value['seria'];?>">

             <input type="text" name="stud<?=$value['id'];?>"  value="<?=$value['stud'];?>">

               <input type="text" class="kach" name="kach<?=$value['id'];?>"  value="<?=$value['kach'];?>">

              <input type="text" class="mix_title" name="mix_title<?=$value['id'];?>"  value="<?=$value['mix_title'];?>">
                <input type="text" class="rly_path" name="mix_title<?=$value['id'];?>"  value="<?=$value['rly_path'];?>">

              </div>
                    <?php }?>
            <?php } ?>

        </div>



    </form>

    <button class="btn btn-primary" id="ispravit">Исправить</button>

    <button class="btn btn-primary float-right" id="saveChangeSrc">Сохранить</button>



</main>