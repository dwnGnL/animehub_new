<?php


namespace AdminController;


use Lib\Helper;
use Lib\Upload;
use Model\AttrCat;
use Model\Attributes;
use Model\CatProduct;
use Model\Product;

class ProductController extends AdminController
{

    public function view(){
        $productsDB = new Product();
        $products = $productsDB->getProducts();
        $this->index = $this->app->view()->fetch('dashboard/viewProducts.tpl.php', [
            'products' => $products,
            'helper' => Helper::getInstance(),
            'app' => $this->app,
            'uri' => $this->getUri(),
        ]);
        $this->display();
    }

    public function edit($id){
        $productsDB = new Product();
        $catDB = new CatProduct();
        $attrDB = new Attributes();
        $cats = $catDB->row('id_cat_pr,name_cat');
        $attr = $attrDB->getAttributes($id);
        $product = $productsDB->getProductInfo($id);
        $action = $this->app->urlFor('updateProduct');
        $this->index = $this->app->view()->fetch('dashboard/addProduct.tpl.php',[
            'cats' => $cats,
            'attr' => $attr,
            'product' => $product,
            'uri' => $this->uri,
            'action' => $action
        ]);
        $this->display();
    }

    public function update($id){
       $productDB = new Product();
       $product = $productDB->getProductInfo($id);
        $update = $productDB->update([
            'name_product' => $_POST['title'],
            'price_product' => $_POST['price'],
            'text_product' => $_POST['text'],
            'img_product' => Upload::can_upload($_FILES['img1']) ? Upload::make_upload($_FILES['img1']) : $product['img_product'],
            'id_cat_pr' => $_POST['cat']
        ], $id);
        if ($update) {
            if (isset($_FILES['img1']['name']) && !empty($_FILES['img1']['name'])){
                unlink($this->app->root() . $product['img_product']);
            }
            return $this->app->redirectTo('products');
        }
        return $this->app->redirectTo('products');
    }

    public function delete($id){
        $productDB = new Product();
        $delete =  $productDB->delete($id);
        if ($delete){
            echo json_encode([
                'status' => 200,
            ]);
        }else{
            echo json_encode([
                'status' => 500,
            ]);
        }
    }
}