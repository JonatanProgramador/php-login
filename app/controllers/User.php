<?php
require_once RUTA . "app/requests/UserRequest.php";
require_once RUTA . "app/requests/UserTokenRequest.php";
require_once RUTA . "app/models/UserModel.php";
require_once RUTA . "app/resourcers/UserResourcer.php";

class User
{
  public static function index(): void
  {
    echo "Index";
  }

  public static function show($id): void
  {
      $user = new UserModel();
 
      if (Token::compareToken()) {
        if (Response::$data[0]["user_id"] == $id) {
          $user->findById($id);
          $resourcer = new UserResourcer();
          Response::$data = $resourcer->get();
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
