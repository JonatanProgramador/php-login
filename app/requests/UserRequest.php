<?php
require_once "Request.php";

class UserRequest extends Request {

    public function __construct()
    {
        parent::__construct(["name", "password"]);
    }
}