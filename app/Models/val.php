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

    public function is_user_exsist($username)
    {
        if ($this->get_user($username)) {
            return true;
        } else {
            return false;
        }

    }
    public function get_user($username)
    {

        $user = $this->builder->select('users', ['username'])
                        ->WHERE(['username'], [$username], ['='])
                        ->GET()
                        ->execute();

        return $user;

    }

    public function is_password_wrong($username, $pwd)
    {
        $hashedpwd = $this->get_password($username);
        
        if (password_verify($pwd, $hashedpwd)) {
            return false;
        } else {
            return true;
        }

    }
    public function get_password($username)
    {
        $user = $this->builder->select('users', ['username', 'pwd'])
                ->WHERE(['username'], [$username], ['='])
                ->GET()
                ->execute();
        
        return $user[0]['pwd'] ?? null;

    }   

    public function is_email_registered($email)
    {
        if ($this->get_email($email)) {
            return true;
        } else {
            return false;
        }
    }
    public function get_email($email)
    {

        $user = $this->builder->select('users', ['username'])
                        ->WHERE(['email'], [$email], ['='])
                        ->GET()
                        ->execute();
        
        return $user;

    }

}