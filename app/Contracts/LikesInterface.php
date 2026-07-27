<?php

namespace Contracts;

interface LikesInterface 
{
    public function toggleLike($post_id, $user_id);
}