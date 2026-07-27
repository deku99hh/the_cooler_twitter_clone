<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;

class follows extends model{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    // a follows b

    // all b'es
    public function get_follows($my_id)
    {
        // $users = $this->builder->select('users', ['username', 'verified', 'name', 'user_id'])
        //     ->join('follows', 'users.user_id', 'follows.user_who_follow', 'inner')
        //     ->WHERE(['follows.user_who_follow'], [$my_id], ['='])
        //     ->GET()
        //     ->execute();
        $users = $this->builder->select('users', ['username', 'verified', 'name', 'user_id'])
            ->join('follows', 'users.user_id', 'follows.user_who_is_followed', 'inner')
            ->WHERE(['follows.user_who_follow'], [$my_id], ['='])
            ->GET()
            ->execute();

        return $users;
    }

    // a follows
    public function get_followeds($my_id)
    {
        $users = $this->builder->select('users', ['username', 'verified', 'name', 'user_id'])
            ->join('follows', 'users.user_id', 'follows.user_who_is_followed', 'inner')
            ->WHERE(['follows.user_who_is_followed'], [$my_id], ['='])
            ->GET()
            ->execute();

        return $users;
    }



    public function get_follows_num($user_id)
    {
        $who_follows_A = $this->get_follows($user_id);
        return count($who_follows_A);
    }

    public function get_followeds_num($user_id)
    {
        $who_A_is_following = $this->get_followeds($user_id);
        return count($who_A_is_following);
    }

    public function doIFollowHem($user_id)
    {
        $my_id = $_SESSION['user_info']['id'];
        $myfolloeds = $this->get_follows($my_id);
        foreach ($myfolloeds as $user) {
            if ($user['user_id'] == $user_id) {
                return true;
            }
        }
        return false;
    }

    public function followTo($user_id)
    {
        $followTo = $this->builder->create(
            'follows', 
            ['user_who_follow', 'user_who_is_followed'], 
            [$_SESSION['user_info']['id'], $user_id]
        )->execute();

    }

    public function unfollowTo($user_id)
    {
        $this->builder->WHERE(['user_who_follow', 'user_who_is_followed'], [$_SESSION['user_info']['id'], $user_id], ['=', '='])
            ->DELETE('follows')
            ->execute();

    }


}
