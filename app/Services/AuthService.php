<?php

namespace Services;

use Models\user;
use Models\val;

use Contracts\AuthServiceInterface;

class AuthService implements AuthServiceInterface{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new user();
        $this->userModel = new user();
        $this->validationModel = new val();

    }

    public function validateLogin($username, $pwd)
    {
        $errors = [];

        if ($this->isInputEmpty($username, $pwd)) {
            $errors['empty_input'] = "fill in all fields!";
        }
        else {
            if (!$this->validationModel->doesUserExsist($username) || $this->validationModel->isPasswordWrong($username, $pwd)) {
                $errors['wrong_username_or_password'] = "wrong username or password!";
            }
        }

        return $errors;
    }
    
    public function validateSignup($username, $pwd, $email)
    {
        $errors = [];

        if ($this->isInputEmpty($username, $pwd, $email)) {
            $errors['empty_input'] = "fill in all fields!";
        } else {
            if ($this->isEmailInvalid($email)) {
                $errors['invalid_email'] = "invalid email used!";
            }
            if ($this->validationModel->doesUserExsist($username)) {
                $errors['username_taken'] = "username already taken!";
            }
            if ($this->validationModel->isEmailRegistered($email)) {
                $errors['email_used'] = "email alredy registerd!";
            }

        }    

        return $errors;
    }



    public static function isInputEmpty($username, $pwd, $email = null) 
    {
        if (empty($username) || empty($pwd)) {
            return true;
        }
        if ($email !== null && empty($email)) {
            return true;
        }
        return false;
    }
    public static function isEmailInvalid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }



}    
