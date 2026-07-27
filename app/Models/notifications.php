<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\NotificationsInterface;

class notifications extends model implements NotificationsInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function sendNotificationToMyFollowers($who_follows_me, $text)
    {
        foreach ($who_follows_me as $one_who_follow_me) {
            $this->builder->create('notification', 
                ['user_id', 'post_id', 'notification_text'], 
                [$one_who_follow_me['user_id'], null, $text]
            )->execute();
        }
    }

    public function sendNotificationToAuthor($user_id, $post_id, $text)
    {
        $this->builder->create('notification', 
            ['user_id', 'post_id', 'notification_text'], 
            [$user_id, $post_id, $text]
        )->execute();
    }

    public function getMyNotification($user_id, $myfollows)
    {

        $notifications = $this->builder->selectAll('notification')
            ->GET()
            ->execute();

        $result = [];

        for ($i=0; $i < count($notifications) ; $i++) { 

            foreach ($myfollows as $follow) {
                if ($follow['user_id'] == $notifications[$i]['user_id']) {
                    $result[$i] = $notifications[$i];
                }
            }
        
        }

        return $result;
    }
}
