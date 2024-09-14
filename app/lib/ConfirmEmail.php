<?php
require_once RUTA . "app/models/VerificationCodeModel.php";

class ConfirmEmail {


    public static function generate($user_id) {
        $TIME = 3;
        $code = bin2hex(random_bytes(10));
        date_default_timezone_set("Europe/Madrid");
        $hora = date_create(date("H:i:s"));
        $hora->add(DateInterval::createFromDateString($TIME . ' minutes'));
        $expire = date("y-m-d") . " " . $hora->format("H:i:s");
        $model = new VerificationCodeModel();
        $model->insert(["user_id"=>$user_id, "code"=>$code, "expire"=>$expire ]);
        return $code; 
    }
}