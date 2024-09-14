<?php
require_once RUTA . "app/requests/UserRequest.php";
require_once RUTA . "app/models/UserModel.php";
require_once RUTA . "app/resourcers/UserResourcer.php";

class Auth
{
    public static function  index(): void
    {
        if (!empty($_SERVER["PHP_AUTH_USER"]) && !empty($_SERVER["PHP_AUTH_PW"])) {
            $user = new UserModel();
            $user->find(["name" => $_SERVER["PHP_AUTH_USER"]]);
            if (Response::$data !== null && count(Response::$data) > 0) {
                if (Response::$data[0]["password"] == hash("sha256", $_SERVER["PHP_AUTH_PW"])) {
                    if (Response::$data[0]["emailConfirm"] == "TRUE") {
                        $resourcer = new UserResourcer();
                        Response::$data = $resourcer->get()[0];
                        $id = Response::$data["id"];
                        $token = Token::generateToken($id);
                        $roles = Rol::getRol($id);
                        $roles = count($roles) == 0 ? null : $roles;
                        Response::$code = 200;
                        Response::$data = ["id" => $id, "token" => $token, "rol" => $roles];
                        Response::$message = "Contraseña correcta";
                    } else {
                        ConfirmEmail::generate(Response::$data[0]["id"]);
                        Response::$code = 206;
                        Response::$data = null;
                        Response::$message = "Email no confirmado";
                    }
                } else {
                    Response::$code = 205;
                    Response::$data = null;
                    Response::$message = "Contraseña incorrecta";
                }
            } else {
                Response::$code = 204;
                Response::$data = null;
                Response::$message = "Usuario no registrado";
            }
        } else {
            Response::$code = 500;
            Response::$data = null;
            Response::$message = "Datos no validos";
        }
        Response::send();
    }
}
