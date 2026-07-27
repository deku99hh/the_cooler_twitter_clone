<?php

namespace Contracts;

interface AuthServiceInterface 
{
    public function validateLogin($username, $pwd);

    public function validateSignup($username, $pwd, $email);

    public static function is_input_empty($username, $pwd, $email = null);
    
    public static function is_email_invalid($email);
}