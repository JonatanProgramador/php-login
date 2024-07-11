<?php
require_once RUTA . "app/database/Migration.php";
class Migrar {
    public static function index() :void
    {
        Migration::start("run");
    }

    public static function delete($id) :void
    {
        Migration::start("drop");
    }
}