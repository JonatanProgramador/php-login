<?php

class Migration
{

    public static  function start($mode)
    {

        $migrations = scandir(RUTA . 'database/migrations/');
        unset($migrations[0]);
        unset($migrations[1]);


        foreach ($migrations as $migra) {
            require_once RUTA . 'database/migrations/' . $migra;
        }

        $migrations = array_map(function ($migra) {
            return substr($migra, 0, -4);
        }, $migrations);

        foreach ($migrations as $migra) {
            call_user_func_array([$migra, $mode], []);
        }
    }
}
