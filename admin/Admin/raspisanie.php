<style>
.serii_close{
    display:none;
  }
  .raspisanie_title {
      text-align: center;
      display:none;
      margin-bottom:20px;
  }

  .raspisanie_title .list-group-item{
    background-color: #efecec ;
  }
  .exit2 {
  display: inline-block;
  position:absolute;
  top:15px;
  right:15px;
  width: 35px;
  margin-left: 20px;
  height: 35px;
  font-size: 50px;
  line-height: 0px;
  overflow: hidden;
  text-align: center;
  padding-top: 11px;
  margin: 2px;
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -o-user-select: none;
}

  .raspisanie_title i{
      float: right;
  }
  .raspisanie_title .list-group{
      text-align: start;
  }
  .serii_close .list-group-item{
      background: white;
  }
  .serii_close .list-group-item a{
    color: red;
      text-decoration: none;
  }
</style>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <h4 class="">Расписание выхода серий</h4>
        <div class="card mb-4 wow fadeIn" style="display: inline-block;width: 100%;">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1" id="otvet">
                </h4>

                    <?php
                    require_once 'lib/Model.php';
                    $model = new Model();
                    ?>
                    <img src="../img/gif/Load.gif" id="load" class="invisible" alt="#">
                        <select name="den" class="form-control" id="den" style="width:15%;height: 53px;">
                            <?php $den = $model->getDen();
                            foreach ($den as $value){
                            ?>
                          <option value="<?=$value['id'];?>"><?=$value['title_den'];?></option>
                            <?php }?>

                        </select>
                    <input type="search" name="search" class="form-control" id="titleAnimeR" placeholder="Название аниме" style="width:70%;">

            </div>
            <button type="button" id="saveRas" class="btn btn-primary" style="float:right;">Confirm</button>
        </div>
    </div>
    <button class="btn btn-primary rasp" style="width:100%;">Показать расписание</button>
     <script>
      
      $("button.rasp").click(function() { 
        $("div.list-group.raspisanie_title").slideToggle(300);
        
      });
      
    </script>
                <div class="list-group raspisanie_title">
       
      <div href="#" class="list-group-item list-group-item-action uved raspisan" >
        Понедельник
        
        <i class="fa fa-plus fa-minus"></i>
        
        <div class="serii_close">
            <div class="list-group">
                <?php $raspisanie = $model->getPonedelnik();
                    foreach ($raspisanie as $value) {
                ?>
                    <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                       <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                    </div>
                    <?php } ?>
            </div>
        </div>
        </div>
        <div href="#" class="list-group-item list-group-item-action uved" >
                Вторник
                
                <i class="fa fa-plus fa-minus"></i>
                
                <div class="serii_close">
                    <div class="list-group">
                        <?php $raspisanie = $model->getVtornik();
                        foreach ($raspisanie as $value) {
                            ?>
                            <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                                <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                </div>
                     <div href="#" class="list-group-item list-group-item-action uved" >
                         Среда

                         <i class="fa fa-plus fa-minus"></i>

                         <div class="serii_close">
                             <div class="list-group">
                                 <?php $raspisanie = $model->getSreda();
                                 foreach ($raspisanie as $value) {
                                     ?>
                                     <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                                         <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                                     </div>
                                 <?php } ?>

                             </div>
                         </div>
                     </div>
                     <div href="#" class="list-group-item list-group-item-action uved" >
                         Четверг

                         <i class="fa fa-plus fa-minus"></i>

                         <div class="serii_close">
                             <div class="list-group">
                                 <?php $raspisanie = $model->getChetverg();
                                 foreach ($raspisanie as $value) {
                                     ?>
                                     <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                                         <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                                     </div>
                                 <?php } ?>

                             </div>
                         </div>
                     </div>
                     <div href="#" class="list-group-item list-group-item-action uved" >
                         Пятница

                         <i class="fa fa-plus fa-minus"></i>

                         <div class="serii_close">
                             <div class="list-group">
                                 <?php $raspisanie = $model->getPyatnisa();
                                 foreach ($raspisanie as $value) {
                                     ?>
                                     <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                                         <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                                     </div>
                                 <?php } ?>

                             </div>
                         </div>
                     </div>
                     <div href="#" class="list-group-item list-group-item-action uved" >
                         Суббота

                         <i class="fa fa-plus fa-minus"></i>

                         <div class="serii_close">
                             <div class="list-group">
                                 <?php $raspisanie = $model->getSubbota();
                                 foreach ($raspisanie as $value) {
                                     ?>
                                     <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                                         <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                                     </div>
                                 <?php } ?>

                             </div>
                         </div>
                     </div>
                     <div href="#" class="list-group-item list-group-item-action uved" >
                         Воскресенье

                         <i class="fa fa-plus fa-minus"></i>

                         <div class="serii_close">
                             <div class="list-group">
                                 <?php $raspisanie = $model->getVoskresenie();
                                 foreach ($raspisanie as $value) {
                                     ?>
                                     <div href="#" class="list-group-item list-group-item-action uved" id="<?=$value['id'].'div';?>" >
                                         <a href="#"><?=$value['title_anime']?></a>  <li class="exit2" id="<?=$value['id']?>" >&#215;</li>
                                     </div>
                                 <?php } ?>

                             </div>
                         </div>
                     </div>
      
        </div>
        <script>
      
      $("div.uved").click(function() { 
        $(this).find("i.fa").toggleClass("fa-plus");
        $(this).find("div.serii_close").slideToggle(300);
        
      });
      $(".exit2").click(function(event){
          	event.stopPropagation()
      });
    
    </script>
    <script src="js/uved.js"></script>
</main>