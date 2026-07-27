<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;

class posts extends model{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function get_posts()
    {

    if (isset($_SESSION['user_info'])) {
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
                    'IF(stars.user_id IS NOT NULL, 1, 0)' => 'is_stared'
                ])
                ->join('posts', 'users.user_id', 'posts.user_id', 'inner')
                ->join('likes', 'posts.post_id', 'likes.post_id', 'left')
                ->join('stars', 'posts.post_id', 'stars.post_id', 'left', 'AND stars.user_id = ' . $_SESSION['user_info']['id'])
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

    }
    else {
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
                ])
                ->join('posts', 'users.user_id', 'posts.user_id', 'inner')
                ->join('likes', 'posts.post_id', 'likes.post_id', 'left')
                ->groupBy([
                    'users.user_id',
                    'users.username',
                    'users.name',
                    'users.verified',
                    'posts.post_id',
                    'posts.post_text',
                    'posts.created_at',
                ])
                ->GET()
                ->execute();
    }

        return $posts;

    }

    public function get_posts_by_follows($my_id)
    {
        $posts = $this->builder
            ->select('users', [
                'users.user_id'    => 'user_id',
                'users.username'   => 'username',
                'users.name'       => 'name',
                'users.verified'   => 'verified',
                'posts.post_id'    => 'post_id',
                'posts.post_text'  => 'post_text',
                'posts.created_at' => 'created_at',
                'COALESCE(COUNT(DISTINCT likes.user_id), 0)' => 'total_likes',
                'MAX(IF(likes.user_id = '.$my_id.', 1, 0))'     => 'is_liked',
                'IF(stars.user_id IS NOT NULL, 1, 0)'       => 'is_stared'
            ])
            ->join('posts', 'users.user_id', 'posts.user_id', 'inner')
            ->join('follows', 'users.user_id', 'follows.user_who_is_followed', 'inner')
            ->join('likes', 'posts.post_id', 'likes.post_id', 'left')
            ->join('stars', 'posts.post_id', 'stars.post_id', 'left', 'AND stars.user_id = '.$my_id)
            ->WHERE(['follows.user_who_follow'], [$my_id], ['='])
            ->groupBy([
                'users.user_id',
                'users.username',
                'users.name',
                'users.verified',
                'posts.post_id',
                'posts.post_text',
                'posts.created_at',
                'stars.user_id',
                'stars.user_id'
            ])
            ->GET()
            ->execute();

        return $posts;
    }

    public function new_post($post_dsta)
    {
        $newUserId = $this->builder->create(
            'posts', 
            ['post_text', 'user_id'], 
            [$post_dsta['post_text'], $post_dsta['user_id']]
        )->execute();

        return 1;
    }

    public function get_post_by_id($post_id)
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
                'COUNT(likes.post_id)' => 'total_likes',
                'IF(stars.user_id IS NOT NULL, 1, 0)' => 'is_stared'
            ])
            ->join('posts', 'users.user_id', 'posts.user_id', 'inner')
            ->join('likes', 'posts.post_id', 'likes.post_id', 'left')
            ->join('stars', 'posts.post_id', 'stars.post_id', 'left', 'AND stars.user_id = ' . $_SESSION['user_info']['id'])
            ->WHERE(['posts.post_id'], [$post_id], ['='])
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

        return $result[0] ?? null;
    }

    public function get_author_id($post_id)
    {
        $result = $this->builder
            ->select('posts', [
                'posts.user_id',
            ])
            ->WHERE(['posts.post_id'], [$post_id], ['='])
            ->GET()
            ->execute();

        return $result[0] ?? null;
    }


}
