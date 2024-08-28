<?php
require_once RUTA. "app/models/RolModel.php";

class CreateTable03Rol {
    public static function run() 
    {
        $rolModel = new RolModel();

        $rol = new Column("rol", Column::STRING);
        $rol->notNull();

        $user = new Column("user_id", Column::INTEGER);
        $user->notNull();
        $user->foreignKey("users", "id");

        $primariKey = new Column();
        $primariKey->primaryKeyConstraint(["rol", "user_id"]);
        $rolModel->create([$rol, $user, $primariKey]);
        Response::send();
    }

    public static function drop() 
    {
        $rolModel = new RolModel();
        $rolModel->drop();
        Response::send();
    }
}