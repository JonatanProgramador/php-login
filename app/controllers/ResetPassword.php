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

    public static function update($code) :void
    {
        $codeManager = new CodeManager(new ResetPassCodeModel);
        $user_id = $codeManager->confirm($code);
        $passwrod = json_decode(file_get_contents('php://input'), true)["password"];

        if(!empty($user_id) && !empty($passwrod)) {
            $user = new UserModel();
            $user->updateById($user_id, ["password" => hash("sha256", $passwrod)]);
            Response::empty();
            Response::$code = 200;
            Response::$data = "Se a restablecido la contraseña."; 
        } else {
            Response::empty();
            Response::$code = 500;
            Response::$data = "error en el codigo";
        }
        Response::send();
    }
}
