<?php

class ConfirmarEmail {
    function show($code) {
        if(ConfirmEmail::confirm($code)) {
            Response::$code = 200;
            Response::$data = null;
            Response::$message = "Confirmado el Email";
        } else {
            Response::$code = 500;
            Response::$data = null;
            Response::$message = "Error al Confirmado el Email";
        }
        Response::send();
    }
}