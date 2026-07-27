<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\CommentsInterface;

class comments extends model implements CommentsInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function newComment($comment_data)
    {
        $newUserId = $this->builder->create(
            'comments', 
            ['comments_text', 'post_id', 'user_id'], 
            [$comment_data['comments_text'], $comment_data['post_id'], $comment_data['user_id']]
        )->execute();

        return 1;
    }

    public function getCommentsByPostId($post_id)
    {
        $comments = $this->builder
            ->select('users', [
                'users.username'         => 'username',
                'users.name'             => 'name',
                'users.verified'         => 'verified',
                'comments.comments_text' => 'comments_text',
                'comments.created_at'    => 'created_at',
                'comments.id'            => 'id'
            ])
            ->join('comments', 'users.user_id', 'comments.user_id', 'inner')
            ->WHERE(['comments.post_id'], [$post_id], ['='])
            ->GET()
            ->execute();
        
        return $comments;
    }

}