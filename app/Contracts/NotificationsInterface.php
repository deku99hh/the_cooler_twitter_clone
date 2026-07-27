<?php

namespace Contracts;

interface NotificationsInterface 
{
    public function sendNotificationToMyFollowers($who_follows_me, $text);

    public function sendNotificationToAuthor($author_id, $post_id, $text);

    public function getMyNotification($user_id, $myfollows);
}