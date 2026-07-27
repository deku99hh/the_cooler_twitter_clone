<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;

class stars extends model{
    
    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function toggle_star($stars_data)
    {
        $existingStar = $this->builder->selectAll("stars")
                ->WHERE(["post_id", "user_id"], [ $stars_data['post_id'], $stars_data['user_id'] ], ['=', '='])
                ->GET()
                ->execute();

        if (empty($existingStar)) {
            $this->builder->create(
                'stars',
                ['user_id', 'post_id'],
                [$stars_data['user_id'], $stars_data['post_id']]
            )->execute();

            return 1;
        }

        $this->builder->WHERE(['user_id', 'post_id'], [$stars_data['user_id'], $stars_data['post_id']], ['='])
            ->DELETE('stars')
            ->execute();
        return 0;
    }


    public function getPostsWithMyStars($stars_data)
    {
        $result = $this->builder
            ->select('users', [
                'users.user_id'    => 'user_id',
                'users.username'   => 'username',
                'users.name'       => 'name',
                'users.verified'   => 'verified',
                'posts.post_text'  => 'post_text',
                'posts.created_at' => 'created_at',
                'posts.post_id'    => 'post_id',
                'COUNT(likes.post_id)' => 'total_likes'
            ])
            ->join('posts', 'users.user_id', 'posts.user_id', 'inner')
            ->join('likes', 'posts.post_id', 'likes.post_id', 'left')
            ->join('stars', 'posts.post_id', 'stars.post_id', 'inner')

            ->WHERE(['stars.user_id'], [$stars_data['user_id']], ['='])

            ->groupBy([
                'users.user_id',
                'users.username',
                'users.name',
                'users.verified',
                'posts.post_text',
                'posts.created_at',
                'posts.post_id'
            ])
            ->GET()
            ->execute();

        return $result;

    }


}