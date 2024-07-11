<?php
require_once RUTA . "requests/UserRequest.php";
require_once RUTA . "models/UserModel.php";

class User
{
  public function index(): void
  {
    echo "Index";
  }

  public function show($id): void
  {
    echo "Ver " . $id;
  }

  public function store(): void
  {
    $request = new UserRequest();
    if ($request->isValid()) {
      $user = new UserModel();
      $data = json_decode(file_get_contents('php://input'), true);
      $data["password"] = hash("sha256", $data["password"]);
      $user->insert($data);
    } else {
     Response::$code=500;
     Response::$message = "Datos no validos";
    }
    Response::send();
  }

  public function update($id): void
  {
    echo "actualizando " . $id;
  }

  public function delete($id): void
  {
    echo "eliminando " . $id;
  }
}
