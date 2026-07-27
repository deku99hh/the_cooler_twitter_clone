<?php

namespace Contracts;

interface PostsInterface 
{
    public function getPosts();

    public function getPostsByFollows($my_id);

    public function newPost($post_dsta);

    public function getPostById($post_id);

    public function getAuthorIdByPostId($post_id);
}