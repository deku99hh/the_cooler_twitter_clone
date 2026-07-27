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
    
    public function get_user_data($username)
    {

        $user = $this->builder->select('users', ['username', 'email', 'verified', 'name', 'user_id', 'created_at', 'about_text', 'birthday', 'links'])
                    ->WHERE(['username'], [$username], ['='])
                    ->GET()
                    ->execute();

        return $user[0] ?? null;
    }

    public function get_user_data_by_id($user_id)
    {

        $user = $this->builder->select('users', ['username', 'email', 'verified', 'name', 'user_id', 'created_at', 'about_text', 'birthday', 'links'])
                    ->WHERE(['user_id'], [$user_id], ['='])
                    ->GET()
                    ->execute();

        return $user[0] ?? null;
    }


    public function creat_user($username, $name, $pwd, $email)
    {
        $this->set_user($username, $name, $pwd, $email);
    }
    public function set_user($username, $name, $pwd, $email)
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