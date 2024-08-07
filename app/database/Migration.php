<?php

class Migration
{

    public static  function start($mode)
    {

        $migrations = scandir(RUTA . 'app/database/migrations/');
        unset($migrations[0]);
        unset($migrations[1]);


        foreach ($migrations as $migra) {
            require_once RUTA . 'app/database/migrations/' . $migra;
        }

        $migrations = array_map(function ($migra) {
            return substr($migra, 0, -4);
        }, $migrations);

        $migrations = $mode == "drop"?array_reverse($migrations):$migrations;

        foreach ($migrations as $migra) {
            call_user_func_array([$migra, $mode], []);
        }
    }
}
