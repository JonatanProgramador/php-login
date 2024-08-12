<?php
require_once RUTA . "app/requests/UserRequest.php";
require_once RUTA . "app/models/UserModel.php";
require_once RUTA . "app/resourcers/UserResourcer.php";

class Auth
{
    public static function  store(): void
    {
        $request = new UserRequest();
        if ($request->isValid()) {
            $user = new UserModel();
            $data = json_decode(file_get_contents('php://input'), true);
            $user->find(["name" => $data["name"]]);
            if(Response::$data !== null && count(Response::$data)>0) {
                if(Response::$data[0]["password"] == hash("sha256",$data["password"])) {
                    $resourcer = new UserResourcer(); 
                    Response::$data = $resourcer->get();
                    Token::generateToken(Response::$data["id"]);
                    Response::$code = 200;
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
