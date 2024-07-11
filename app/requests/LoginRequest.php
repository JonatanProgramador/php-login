<?php
require_once "Request.php";

class LoginRequest extends Request {

    public function __construct()
    {
        parent::__construct(["name", "password"]);
    }
}