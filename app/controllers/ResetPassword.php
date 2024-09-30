<?php

require_once RUTA . "app/models/ResetPassCodeModel.php";

class ResetPassword
{

    public static function store(): void
    {
        $email = json_decode(file_get_contents('php://input'), true)["email"];

        if (!empty($email)) {
            $id = Email::validateEmail($email);
            if (!empty($id)) {
                $generate = new CodeManager(new ResetPassCodeModel());
                //enviar email
                $url = $generate->generate($id, 4);
                Email::send($email, $email, "Reset password", "Resetear password", "el codigo para resetear la contraseña es: ".$url);
                Response::$code = 200;
                Response::$message = "enviado codigo de reseteo";
            } else {
                Response::$code = 500;
                Response::$message = "El email no esta registrado";
            }
        } else {
            Response::$code = 500;
            Response::$message = "Es necesario pasar un email.";
        }
        Response::send();
    }
}
