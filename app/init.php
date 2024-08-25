<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


$libs = scandir(RUTA . 'app/lib/');
unset($libs[0]);
unset($libs[1]);


foreach($libs as $migra) {
    require_once RUTA . 'app/lib/'.$migra;
} 


$init = new Core;