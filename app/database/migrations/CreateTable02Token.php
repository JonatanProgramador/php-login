<?php
require_once RUTA. "app/models/TokenModel.php";

class CreateTable02Token {

   
public static function run() 
{
    $tokenTable = new TokenModel();

    $id = new Column("id", Column::INTEGER);
    $id->notNull();
    $id->primaryKey();
    $id->autoIncrement();

    $userId = new Column("user_id", Column::INTEGER);
    $userId->foreignKey("users", "id");

    $token = new Column("token", Column::TEXT);
    $token->notNull();

    $expire = new Column("expire", Column::DATE);
    $expire->notNull();

    $tokenTable ->create([$id, $userId]);
    Response::send();
}

public static function drop()
{
    $tokenTable = new TokenModel();
    $tokenTable->drop();
    Response::send();
}
}