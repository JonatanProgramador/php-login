<?php

require_once RUTA. "models/UserModel.php";

class CreateTableUser {

   
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

        $password = new Column("password", Column::STRING);
        $password->notNull();

        $message = new Column("message", Column::TEXT);

        $user->create([$id, $nombre, $password, $message]);
        Response::send();
    }

    public static function drop()
    {
        $user = new UserModel();
        $user->drop();
        Response::send();
    }
}
