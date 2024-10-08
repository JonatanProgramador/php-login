<?php
require_once RUTA . "app/requests/UserRequest.php";
require_once RUTA . "app/requests/UserTokenRequest.php";
require_once RUTA . "app/models/UserModel.php";
require_once RUTA . "app/resourcers/UserResourcer.php";
require_once RUTA . "app/models/RolModel.php";
require_once RUTA . "app/models/VerificationCodeModel.php";

class User
{
  public static function index(): void
  {
    $user = new UserModel();

    if (Token::compareToken()) {
      if (Rol::compareRol(Response::$data[0]["user_id"], "admin")) {
        $user->get();
        $users_data = Response::$data;
        Response::$data = array_map(function ($value) {
          $value["rols"] = Rol::getRol($value["id"]);
          return $value;
        }, $users_data);
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
        $user_data = Response::$data;
        $user_data[0]["rols"] = Rol::getRol($id);
        Response::$data = $user_data;
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

      if (Response::$code == 200) {

        $user->find(["name" => $data["name"]]);
        $codeManager = new CodeManager(new VerificationCodeModel());
        $code = $codeManager->generate(Response::$data[0]["id"], 10);
        $url = HOST . "confirmaremail/" . $code;

        Email::send(Response::$data[0]["name"], Response::$data[0]["email"], "Confirm Email", "Confirmar email", $url);
        if (Response::$code == 200) {
          Response::$error = null;
        }
        Response::$data = null;
      } else {
        Response::$code = 500;
        Response::$message = "Error al insertar user";
      }
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
