<?php
require_once RUTA . "app/models/VerificationCodeModel.php";
require_once RUTA . "app/models/UserModel.php";

class ConfirmarEmail
{
    function show($code)
    {
        $codeManager = new CodeManager(new VerificationCodeModel());
        $user_id = $codeManager->confirm($code);
        if (!empty($user_id)) {
            $user = new UserModel();
            $user->updateById($user_id, ["emailConfirm" => "TRUE"]);
            if (Response::$code == 200) {
                Response::$code = 200;
                Response::$data = null;
                Response::$message = "Confirmado el Email";
            }
        } else {
            Response::$code = 500;
            Response::$data = null;
            Response::$message = "Error al Confirmado el Email";
        }
        Response::send();
    }
}
