<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\SearchInterface;

class search extends model implements SearchInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function search($key_words)
    {
        $key_words = "%" . $key_words . "%";
        $posts = $this->builder
                ->select('users', [
                    'users.user_id'    => 'user_id',
                    'users.username'   => 'username',
                    'users.name'       => 'name',
                    'users.verified'   => 'verified',
                    'posts.post_id'    => 'post_id',
                    'posts.post_text'  => 'post_text',
                    'posts.created_at' => 'created_at',
                    'COUNT(DISTINCT likes.user_id)' => 'total_likes',
                    'IF(stars.user_id IS NOT NULL, 1, 0)' => 'is_starred'
                ])
                ->join('posts', 'users.user_id', 'posts.user_id', 'inner')
                ->join('likes', 'posts.post_id', 'likes.post_id', 'left')
                ->join('stars', 'posts.post_id', 'stars.post_id', 'left', 'AND stars.user_id = :current_user_id')
                ->WHERE(['posts.post_text'], [$key_words], ['LIKE'])
                ->groupBy([
                    'users.user_id',
                    'users.username',
                    'users.name',
                    'users.verified',
                    'posts.post_id',
                    'posts.post_text',
                    'posts.created_at',
                    'stars.user_id'
                ])
                ->GET()
                ->execute();
        return $posts;
    }
    
}