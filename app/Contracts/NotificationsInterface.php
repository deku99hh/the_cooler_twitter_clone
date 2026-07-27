<?php

namespace Contracts;

interface NotificationsInterface 
{
    public function send_Notification_to_my_followers($who_follows_me, $text);

    public function send_Notification_to_author($author_id, $post_id, $text);

    public function get_my_Notification($user_id, $myfollows);
}