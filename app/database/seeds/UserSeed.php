<?php
require_once RUTA. "app/models/UserModel.php";

const USERDATASEED = [
    ["name"=>"battusay", "password"=>"1234", "message"=>"el poderoso"],
    ["name"=>"gines", "password"=>"5678", "message"=>"el cabezon"],
    ["name"=>"yeff", "password"=>"asdf", "message"=>"el manco"],
    ["name"=>"raven", "password"=>"qwer", "message"=>"el mariquita"]
];

 class UserSeed {

    public static function run()
    {
        $userModel = new UserModel();
        foreach(USERDATASEED as $data) {
            $userModel->insert($data);
            Response::send();
        }
    }
 }