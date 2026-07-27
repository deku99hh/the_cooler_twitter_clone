<?php

namespace Contracts;

interface LikesInterface 
{
    public function toggle_like($post_id, $user_id);
}