<?php

namespace Contracts;

interface FollowsInterface 
{
    public function get_follows($my_id);

    public function get_followeds($my_id);

    public function get_follows_num($user_id);

    public function get_followeds_num($user_id);

    public function doIFollowHem($user_id);

    public function followTo($user_id);

    public function unfollowTo($user_id);
}