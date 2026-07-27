<?php

namespace Contracts;

interface ValInterface 
{
    public function doesUserExsist($username);

    public function getUser($username);

    public function isPasswordWrong($username, $pwd);

    public function getPassword($username);

    public function isEmailRegistered($email);

    public function getEmail($email);
}