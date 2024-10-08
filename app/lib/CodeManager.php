<?php
require_once RUTA . "app/models/UserModel.php";

class CodeManager
{
    private const TIME = 3;
    private $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    public function generate($user_id, $size)
    {
        $code = bin2hex(random_bytes($size));
        date_default_timezone_set("Europe/Madrid");
        $hora = date_create(date("H:i:s"));
        $hora->add(DateInterval::createFromDateString(self::TIME . ' minutes'));
        $expire = date("y-m-d") . " " . $hora->format("H:i:s");
        $this->model->insert(["user_id" => $user_id, "code" => $code, "expire" => $expire]);
        return $code;
    }

    public function confirm($code)
    {
        $this->model->find(["code" => $code]);
        if (count(Response::$data) > 0) {
            date_default_timezone_set("Europe/Madrid");
            $nowDate = date_create(date("y-m-d H:i:s"));
            $date = date_create(Response::$data[0]["expire"]);
            if ($date > $nowDate) {
                $user_id = Response::$data[0]["user_id"];
                $this->model->delete(["code" => $code]);
                Response::empty();
                return $user_id ;
            }
        }
        $this->model->delete(["code" => $code]);
        return "";
    }
}
