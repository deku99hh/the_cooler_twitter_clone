<?php

namespace Contracts;

interface FollowsInterface 
{
    public function getFollows($my_id);

    public function getFolloweds($my_id);

    public function getFollowsNum($user_id);

    public function getFollowedsNum($user_id);

    public function doIFollowHem($user_id);

    public function followTo($user_id);

    public function unfollowTo($user_id);
}