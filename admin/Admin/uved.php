<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <h4 class="">Уведомление</h4>
        <div class="card mb-4 wow fadeIn" style="display: inline-block;width: 100%;">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1" id="otvet">
                </h4>


                    <img src="../img/gif/Load.gif" id="load" class="invisible" alt="#">
                        <select name="usersUved" class="form-control" id="Select" style="width:15%;height: 53px;">
                          <option value="1">Всем</option>
                          <option value="2">Vip</option>
                        </select>
                    <input type="search" name="search" class="form-control" id="titleUved" placeholder="Заголовок" style="width:70%;">

            </div>
            <textarea name="" id="textUved" class="form-control" rows="5" placeholder="Отправить уведомление"></textarea>
            <button type="button" id="sendUved" class="btn btn-primary" style="float:right;">Confirm</button>
        </div>
    </div>

    <script src="js/uved.js"></script>
</main>