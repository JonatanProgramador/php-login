<?php
require_once "Model.php";
class VerificationCodeModel extends Model {

    public function __construct()
    {
        parent::__construct("verificationCodes");
    }
}