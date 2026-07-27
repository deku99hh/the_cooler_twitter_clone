<?php

namespace Contracts;

interface ValInterface 
{
    public function is_user_exsist($username);

    public function get_user($username);

    public function is_password_wrong($username, $pwd);

    public function get_password($username);

    public function is_email_registered($email);

    public function get_email($email);
}