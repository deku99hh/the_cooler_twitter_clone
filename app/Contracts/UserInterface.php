<?php

namespace Contracts;

interface UserInterface 
{
    public function getUserDataByUsername($username);

    public function getUserDataById($user_id);

    public function creatUser($username, $name, $pwd, $email);

    public function setUser($username, $name, $pwd, $email);
}