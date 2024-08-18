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
            if(Response::$data !== null && count(Response::$data)>0) {
                if(Response::$data[0]["password"] == hash("sha256",$_SERVER["PHP_AUTH_PW"])) {
                    $resourcer = new UserResourcer(); 
                    Response::$data = $resourcer->get();
                    $token = Token::generateToken(Response::$data["id"]);
                    Response::$code = 200;
                    Response::$data = ["id" => Response::$data["id"], "token" => $token];
                    Response::$message = "Contraseña correcta";
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
