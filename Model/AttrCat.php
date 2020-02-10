<?php


namespace Model;


class AttrCat extends Model
{
    protected $table = 'lite_attr_cat';
    public function getAttrCat($id_cat){
        $sql = 'SELECT lite_attributes.name_attr, lite_attributes.id_attr, lite_attributes.alias_attr 
                FROM lite_attr_cat, lite_attributes 
                WHERE lite_attributes.id_attr = lite_attr_cat.id_attr
                AND lite_attr_cat.id_cat_product = :id_cat';
        $params = [
            'id_cat' => $id_cat
        ];
        return $this->driver->row($sql,$params);
    }
}