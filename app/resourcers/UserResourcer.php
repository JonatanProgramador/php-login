<?php
require_once 'Resourcers.php';
class UserResourcer extends Resourcers
{

    function __construct()
    {
        parent::__construct(["name", "message", "id"]);
    }
}
