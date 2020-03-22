<?php


namespace Model;


class Product extends Model
{
    protected $table = 'lite_product';
    protected $foreign_key = 'id_product';

    public function getProduct($take = ''){
        if (!empty($take)){
            $take = ' LIMIT '.$take;
        }
        $sql = 'SELECT lite_product.id_product, lite_product.name_product, lite_product.price_product, lite_product.img_product, lite_product.text_product,
                lite_cat_product.name_cat
                FROM lite_product, lite_cat_product 
                WHERE lite_product.id_cat_pr = lite_cat_product.id_cat_pr ORDER BY lite_product.id_product DESC '.$take;
        return $this->driver->row($sql);
    }
    public function getProductInfo($id){
        $sql = 'SELECT lite_product.id_product, lite_product.name_product, lite_product.price_product, lite_product.img_product, lite_product.text_product, lite_cat_product.name_cat, lite_product.id_cat_pr
                FROM lite_product, lite_cat_product 
                WHERE lite_product.id_cat_pr = lite_cat_product.id_cat_pr 
                AND lite_product.id_product = :id ';
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
    public function getProducts(){
        $sql = 'SELECT lite_product.id_product, lite_product.name_product, lite_product.price_product,
                lite_product.img_product, lite_product.text_product, lite_cat_product.name_cat
                FROM lite_product, lite_cat_product
                WHERE lite_product.id_cat_pr = lite_cat_product.id_cat_pr';
        return $this->driver->row($sql);
    }

    public function getProductList($page,$route){
        $fields = 'lite_product.id_product, lite_product.name_product, lite_product.price_product, lite_product.img_product, lite_product.text_product,
                lite_cat_product.name_cat';

        $from = 'lite_product, lite_cat_product';

        $where = 'lite_product.id_cat_pr = lite_cat_product.id_cat_pr ORDER BY lite_product.id_product DESC';
        $params = [];
        $pager = new \Lib\Pager(
            $fields,
            $from,
            $where,
            $page,
            $params,
            QUANTITY,
            QUANTITY_LINKS,
            $this->driver
        );

        $result = [];
        $result['items'] = $pager->get_posts();
        $result['navigation'] = $pager->render($route);
        return $result;

    }

    public function productSearch($search){
        $sql = '';
        $params = [];
        foreach ($search as $key => $val){
            if ($key == 0){
                $and = '';
            }else{
                $and = ' AND ';
            }
            $sql .= $and.'CONCAT(name_product) LIKE :'.$key;
            $params[$key] = '%'.$val.'%';
        }
        $insert = 'SELECT name_product AS title, img_product AS img, id_product as id FROM lite_product
                  WHERE  '.$sql.' LIMIT 5';
        return $this->driver->row($insert,$params);
    }
}