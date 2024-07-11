<?php
class Prueba {
    public function index() :void
    {
    }

    public function show($id) :void
    {
        echo "Ver ".$id;
    }

    public function store() :void
    {
        echo "creando";
    }

    public function update($id) :void
    {
        echo "actualizando ".$id;
    }

    public function delete($id) :void
    {
        echo "eliminando ".$id;
    }
}