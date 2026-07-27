<?php

namespace Contracts;

interface PostsInterface 
{
    public function get_posts();

    public function get_posts_by_follows($my_id);

    public function new_post($post_dsta);

    public function get_post_by_id($post_id);

    public function get_author_id($post_id);
}