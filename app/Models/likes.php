<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\LikesInterface;

class likes extends model implements LikesInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function toggleLike($post_id, $user_id)
    {
        $existingLike = $this->builder
            ->select('likes', ['user_id', 'post_id'])
            ->WHERE(['likes.user_id', 'likes.post_id'], [$user_id, $post_id], ['='])
            ->GET()
            ->execute();

        if (empty($existingLike)) {
            $this->builder->create(
                'likes',
                ['user_id', 'post_id'],
                [$user_id, $post_id]
            )->execute();

            return 1;
        } 

        $this->builder
            ->WHERE(['likes.user_id', 'likes.post_id'], [$user_id, $post_id], ['='])
            ->DELETE('likes')
            ->execute();

        return 0;
    }
    
}