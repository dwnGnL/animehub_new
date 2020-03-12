<?php


namespace Model;


class Attributes extends Model
{
    protected $table = 'lite_attributes';
    public function getAttributes($id){
        $sql = 'SELECT lite_attributes.name_attr, lite_attr_product.val_attr, lite_attributes.alias_attr 
                FROM lite_attributes, lite_attr_product
                WHERE lite_attributes.id_attr = lite_attr_product.id_attr
                AND lite_attr_product.id_product = :id';
        $params = [
            'id' => $id
        ];
        return $this->driver->row($sql,$params);
    }
}