<?php

namespace Contracts;

interface NotificationsControllerInterface 
{
    public function index();

    public function notificate_followers_for_post($author_id);

    public function notificate_author_for_like($post_id);

    public function notificate_author_for_comments($post_id);
}