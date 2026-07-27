<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\UserInterface;

class user extends model implements UserInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }
    
    public function getUserDataByUsername($username)
    {

        $user = $this->builder->select('users', ['username', 'email', 'verified', 'name', 'user_id', 'created_at', 'about_text', 'birthday', 'links'])
                    ->WHERE(['username'], [$username], ['='])
                    ->GET()
                    ->execute();

        return $user[0] ?? null;
    }

    public function getUserDataById($user_id)
    {

        $user = $this->builder->select('users', ['username', 'email', 'verified', 'name', 'user_id', 'created_at', 'about_text', 'birthday', 'links'])
                    ->WHERE(['user_id'], [$user_id], ['='])
                    ->GET()
                    ->execute();

        return $user[0] ?? null;
    }


    public function creatUser($username, $name, $pwd, $email)
    {
        $this->setUser($username, $name, $pwd, $email);
    }
    public function setUser($username, $name, $pwd, $email)
    {

        $options = [ 'cost' => 12 ];
        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $newUser = $this->builder->create(
            'users', 
            ['username', 'name', 'pwd', 'email'], 
            [$username, $name, $hashedpwd, $email]
        )->execute();

    }

}