<?php
require_once RUTA . "app/requests/UserRequest.php";
require_once RUTA . "app/requests/UserTokenRequest.php";
require_once RUTA . "app/models/UserModel.php";
require_once RUTA . "app/resourcers/UserResourcer.php";

class User
{
  public static function index(): void
  {
    $user = new UserModel();
    if (Token::compareToken()) {
      if (Rol::compareRol(Response::$data[0]["user_id"], "admin")) {
        $user->get();
        $resourcer = new UserResourcer();
        Response::$data = $resourcer->get();
      } else {
        Response::$code = 500;
        Response::$message = "No tienes permisos";
        Response::$data = null;
      }
    } else {
      Response::$code = 500;
      Response::$message = "Token error";
      Response::$data = null;
    }
    Response::send();
  }

  public static function show($id): void
  {
    $user = new UserModel();

    if (Token::compareToken()) {
      if (Response::$data[0]["user_id"] == $id) {
        $user->findById($id);
        $resourcer = new UserResourcer();
        Response::$data = $resourcer->get()[0];
      } else {
        Response::$code = 500;
        Response::$message = "El token no coicide con el usuario";
        Response::$data = null;
      }
    } else {
      Response::$code = 500;
      Response::$message = "Token error";
      Response::$data = null;
    }
    Response::send();
  }


  public static function store(): void
  {
    $request = new UserRequest();
    if ($request->isValid()) {

      $user = new UserModel();
      $data = json_decode(file_get_contents('php://input'), true);
      $data["password"] = hash("sha256", $data["password"]);
      $user->insert($data);
      
      $user_id = $user->find(["name"=>$data["name"]]);
      $code = ConfirmEmail::generate($user_id[0]["id"]);
      $url = HOST."confirmaremail/".$code;
      $email = new Email($user_id[0]["name"], $user_id[0]["email"], "Confirm Email", "Confirmar email", $url);
      $email->send();
    } else {
      Response::$code = 500;
      Response::$message = "Datos no validos";
    }
    Response::send();
  }

  public static function update($id): void
  {
    echo "actualizando " . $id;
  }

  public static function delete($id): void
  {
    echo "eliminando " . $id;
  }
}
