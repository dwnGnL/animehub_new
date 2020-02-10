<?php


namespace Model;


class Product extends Model
{
    protected $table = 'lite_product';

    public function getProduct($take = ''){
        if (!empty($take)){
            $take = ' LIMIT '.$take;
        }
        $sql = 'SELECT lite_product.id_product, lite_product.name_product, lite_product.price_product, lite_product.img_product, lite_product.text_product,
                lite_cat_product.name_cat
                FROM lite_product, lite_cat_product 
                WHERE lite_product.id_cat_pr = lite_cat_product.id_cat_pr'.$take;
        return $this->driver->row($sql);
    }
    public function getProductInfo($id){
        $sql = 'SELECT lite_product.id_product, lite_product.name_product, lite_product.price_product, lite_product.img_product, lite_product.text_product, lite_cat_product.name_cat, lite_product.id_cat_pr
                FROM lite_product, lite_cat_product 
                WHERE lite_product.id_cat_pr = lite_cat_product.id_cat_pr 
                AND lite_product.id_product = :id';
        $params = [
            'id' => $id
        ];
        return $this->driver->column($sql,$params);
    }

    public function getProductSimilar($id_cat,$take = ''){
        if (!empty($take)){
            $take = ' LIMIT '.$take;
        }
        $sql = 'SELECT lite_product.id_product, lite_product.name_product, lite_product.price_product, lite_product.img_product, lite_product.text_product,
                lite_cat_product.name_cat
                FROM lite_product, lite_cat_product 
                WHERE lite_product.id_cat_pr = lite_cat_product.id_cat_pr
                AND lite_cat_product.id_cat_pr = :id_cat
                '.$take;
        $params = [
            'id_cat' => $id_cat
        ];
        return $this->driver->row($sql,$params);
    }
}