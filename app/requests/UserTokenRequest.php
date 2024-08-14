<?php
require_once "Request.php";

class UserTokenRequest extends Request {

    public function __construct()
    {
        parent::__construct(["token"]);
    }
}