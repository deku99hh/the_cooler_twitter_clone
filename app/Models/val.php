<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\ValInterface;

class val extends model implements ValInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function doesUserExsist($username)
    {
        if ($this->getUser($username)) {
            return true;
        } else {
            return false;
        }

    }
    public function getUser($username)
    {

        $user = $this->builder->select('users', ['username'])
                        ->WHERE(['username'], [$username], ['='])
                        ->GET()
                        ->execute();

        return $user;

    }

    public function isPasswordWrong($username, $pwd)
    {
        $hashedpwd = $this->getPassword($username);
        
        if (password_verify($pwd, $hashedpwd)) {
            return false;
        } else {
            return true;
        }

    }
    public function getPassword($username)
    {
        $user = $this->builder->select('users', ['username', 'pwd'])
                ->WHERE(['username'], [$username], ['='])
                ->GET()
                ->execute();
        
        return $user[0]['pwd'] ?? null;

    }   

    public function isEmailRegistered($email)
    {
        if ($this->getEmail($email)) {
            return true;
        } else {
            return false;
        }
    }
    public function getEmail($email)
    {

        $user = $this->builder->select('users', ['username'])
                        ->WHERE(['email'], [$email], ['='])
                        ->GET()
                        ->execute();
        
        return $user;

    }

}