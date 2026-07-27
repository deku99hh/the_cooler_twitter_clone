<?php

namespace Contracts;

interface UserInterface 
{
    public function get_user_data($username);

    public function get_user_data_by_id($user_id);

    public function creat_user($username, $name, $pwd, $email);

    public function set_user($username, $name, $pwd, $email);
}