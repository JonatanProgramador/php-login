<?php
class Prueba {
    public static function index() :void
    {
    }

    public static function show($id) :void
    {
        echo "Ver ".$id;
    }

    public static function store() :void
    {
        echo "creando";
    }

    public static function update($id) :void
    {
        echo "actualizando ".$id;
    }

    public static function delete($id) :void
    {
        echo "eliminando ".$id;
    }
}