<?php

class Seed {
    public static  function start() 
    {
        $seeds = scandir(RUTA . 'app/database/seeds/');
        unset($seeds[0]);
        unset($seeds[1]);

        foreach ($seeds as $seed) {
            require_once RUTA . 'app/database/seeds/' . $seed;
        }

        $seeds = array_map(function ($seed) {
            return substr($seed, 0, -4);
        }, $seeds);


        foreach ($seeds as $seed) {
            call_user_func_array([$seed, "run"], []);
        }
    }
}