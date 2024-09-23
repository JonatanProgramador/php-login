<?php
require_once RUTA. "app/models/UserModel.php";

const USERDATASEED = [
    ["name"=>"battusay", "password"=>"1234", "message"=>"el mago", "email"=>"battusay@gmail.com", "emailConfirm"=>"TRUE"],
    ["name"=>"gines", "password"=>"5678", "message"=>"el guerrero", "email"=>"gines@gmail.com"],
    ["name"=>"yeff", "password"=>"asdf", "message"=>"el guardian", "email"=>"yes@gmail.com"],
    ["name"=>"raven", "password"=>"qwer", "message"=>"el sacerdote", "email"=>"raven@gmail.com"]
];

 class UserSeed {

    public static function run()
    {
        $userModel = new UserModel();
        foreach(USERDATASEED as $data) {
            $data["password"] = hash("sha256", $data["password"]);
            $userModel->insert($data);
            Response::send();
        }
        Rol::setRol(1, "admin");
    }
 }