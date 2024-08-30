<?php
require_once RUTA . "app/database/Migration.php";
require_once RUTA . "app/database/Seed.php";
class Migrar {
    public static function index() :void
    {
        Migration::start("run");
        Seed::start();
    }

    public static function delete($id) :void
    {
        Migration::start("drop");
    }
}