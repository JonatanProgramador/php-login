<?php
require_once RUTA . "database/Migration.php";
class Migrar {
    public function index() :void
    {
        Migration::start("run");
    }

    public function delete($id) :void
    {
        Migration::start("drop");
    }
}