<?php
require_once RUTA. "app/models/RolModel.php";

class Rol 
{
    public static function setRol($user_id, $rol) 
    {
        $modelRol = new RolModel();
        $modelRol->insert(["user_id"=>$user_id, "rol"=>$rol]);
    }

    public static function compareRol($user_id, $rol)
    {
        $modelRol = new RolModel();
        $modelRol->find(["user_id"=>$user_id, "rol"=>$rol]);
        return Response::$code == 200;
    }
}