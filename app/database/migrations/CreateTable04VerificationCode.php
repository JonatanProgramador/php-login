<?php

require_once RUTA. "app/models/VerificationCodeModel.php";

class CreateTable04VerificationCode
{
    public static function run() 
    {
        $model = new VerificationCodeModel();

        $id = new Column("id", Column::INTEGER);
        $id->notNull();
        $id->primaryKey();

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
        $model = new VerificationCodeModel();
        $model->drop();
        Response::send();
    }
}