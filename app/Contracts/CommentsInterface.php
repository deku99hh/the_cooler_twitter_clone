<?php

namespace Contracts;

interface CommentsInterface 
{
    public function new_comment($comment_data);

    public function get_comments_by_post_id($post_id);
}