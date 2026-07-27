<?php

namespace Contracts;

interface AuthServiceInterface 
{
    public function validateLogin($username, $pwd);

    public function validateSignup($username, $pwd, $email);

    public static function isInputEmpty($username, $pwd, $email = null);
    
    public static function isEmailInvalid($email);
}