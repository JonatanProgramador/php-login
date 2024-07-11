<?php

require_once '../env.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');




$libs = scandir(RUTA . 'lib/');
unset($libs[0]);
unset($libs[1]);


foreach($libs as $migra) {
    require_once RUTA . 'lib/'.$migra;
} 


$init = new Core;