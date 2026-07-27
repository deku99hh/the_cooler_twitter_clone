<?php

namespace Contracts;

interface CommentsInterface 
{
    public function newComment($comment_data);

    public function getCommentsByPostId($post_id);
}