<?php


namespace Model;


class Vip extends Model
{
    public function getIdVip($id_user){
        $sql = 'SELECT lite_vip.id FROM lite_vip WHERE lite_vip.id_user = :id_user';
        $params = [
            'id_user' =>$id_user
        ];
        return $this->driver->column($sql,$params);

    }

    public function saveVip($login_color, $uved,$vip_status,  $font, $id_vip){

        $sql = 'Update lite_vip SET login_color = :color, update_anime = :uved, vip_status = :status, font = :font 
                WHERE lite_vip.id = :id_vip';
        $params = [
            'color' => $login_color,
            'uved' =>$uved,
            'status' => $vip_status,
            'font' => $font,
            'id_vip' => $id_vip
        ];
        $this->driver->query($sql,$params);
    }

    public  function getVip($id){
        $sql = 'SELECT lite_vip.login_color AS color, lite_vip.update_anime AS uved, lite_vip.vip_status AS status, lite_vip.font AS font
                FROM lite_vip WHERE lite_vip.id = :id ';
        $params = [
            'id' => $id
        ];
        return $this->driver->column($sql,$params);
    }

    public function getAttrVip(){
        $sql = 'SELECT lite_vip';
    }
}