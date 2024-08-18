<?php

require_once RUTA . "app/models/TokenModel.php";



class Token
{
    static function generateToken($user)
    {
        $tokenModel = new TokenModel();
        $TIME = 3;
        $token = bin2hex(random_bytes(10));
        date_default_timezone_set("Europe/Madrid");
        $hora = date_create(date("H:i:s"));
        $hora->add(DateInterval::createFromDateString($TIME . ' minutes'));
        $tokenModel->insert(["user_id" => $user, "token" => $token, "expire" => date("y-m-d") . " " . $hora->format("H:i:s")]);
        return $token;
    }

    static function compareToken()
    {
        $token = explode(" ", apache_request_headers()["Authorization"])[1];
        if (!empty($token)) {
            $tokenModel = new TokenModel();
            $tokenModel->find(["token" => $token]);
            if (count(Response::$data) > 0) {
                date_default_timezone_set("Europe/Madrid");
                $nowDate = date_create(date("y-m-d H:i:s"));
                $date = date_create(Response::$data[0]["expire"]);
                if ($date > $nowDate) {
                    return true;
                } else {
                    Token::deleteToken(Response::$data[0]["id"]);
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function deleteToken($id)
    {
        $tokenModel = new TokenModel();
        $tokenModel->deleteById($id);
    }
}
