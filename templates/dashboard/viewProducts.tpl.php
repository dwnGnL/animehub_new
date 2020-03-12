<div class="container-fluid">
    <div class="form-group">
        <div class="col-md-4 offset-8">
            <label class="sr-only" for="inlineFormInputGroup">Поиск</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Поиск">
            </div>
        </div>
    </div>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Картинка</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Категория</th>
            <th scope="col">Описание</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
        <tr id="<?=$product['id_product']?>">
            <td style="width: 5%;" class="text-center"><img src="<?=$uri.$product['img_product']?>" alt="" height="40" width="40"></td>
            <td><?=$product['name_product']?></td>
            <td><?=$product['price_product']?></td>
            <td><?=$product['name_cat']?></td>
            <td><?=$product['text_product']?></td>
            <td>
                <a class="btn btn-warning btn-circle btn-sm action" href="<?=$app->urlFor('editProduct').'/'.$product['id_product']?>"><i class="fas fa-edit"  aria-hidden="true"></i></a>
                <span class="btn btn-danger btn-circle btn-sm action deletePr" id-product="<?=$product['id_product']?>" href="#"><i class="fas fa-trash"  aria-hidden="true"></i></span>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
