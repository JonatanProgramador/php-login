<?php

require_once RUTA. "app/models/ResetPassCodeModel.php";

class CreateTable05ResetPassCode
{
    public static function run() 
    {
        $model = new ResetPassCodeModel();

        $id = new Column("id", Column::INTEGER);
        $id->notNull();
        $id->primaryKey();
        $id->autoIncrement();

        $user = new Column("user_id", Column::INTEGER);
        $user->notNull();
        $user->foreignKey("users", "id");

        $code = new Column("code", Column::TEXT);
        $code->notNull();

        $expire = new Column("expire", Column::DATE);
        $expire->notNull();

        $model->create([$id, $user, $code, $expire]);
        Response::send();
    }

    public static function drop() 
    {
        $model = new ResetPassCodeModel();
        $model->drop();
        Response::send();
    }
}