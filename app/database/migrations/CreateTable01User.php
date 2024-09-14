<?php

require_once RUTA. "app/models/UserModel.php";

class CreateTable01User {

   
    public static function run() 
    {
        $user = new UserModel();

        $id = new Column("id", Column::INTEGER);
        $id->notNull();
        $id->primaryKey();
        $id->autoIncrement();

        $nombre = new Column("name", Column::STRING);
        $nombre->notNull();
        $nombre->unique();

        $email = new Column("email", Column::STRING);
        $email->notNull();
        $email->unique();

        $password = new Column("password", Column::STRING);
        $password->notNull();

        $message = new Column("message", Column::TEXT);

        $emailConfirm = new Column("emailConfirm", Column::STRING);
        $emailConfirm->notNull();
        $emailConfirm->defaultValue("FALSE");

        $user->create([$id, $nombre, $email, $password, $message, $emailConfirm]);
        Response::send();
    }

    public static function drop()
    {
        $user = new UserModel();
        $user->drop();
        Response::send();
    }
}
