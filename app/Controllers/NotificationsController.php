<?php

namespace Controllers;

use Core\Controller;
use Models\notifications;
use Models\posts;
use Models\follows;

class NotificationsController extends Controller {

    protected $notificationsModel;
    protected $followsModel;
    protected $postsModel;

    public function __construct()
    {
        $this->notificationsModel = new notifications();
        $this->followsModel = new follows();
        $this->postsModel = new posts();
    }

    public function index()
    {
        $myfollows = $this->followsModel->get_follows($_SESSION['user_info']['id']);
        $my_notification = $this->notificationsModel->get_my_Notification($_SESSION['user_info']['id'], $myfollows);

        $data['notifications'] = $my_notification;
        $this->load('notifications', $data);
    }

    public function notificate_followers_for_post($author_id)
    {
        $who_follows_me = $this->followsModel->get_followeds($author_id);
        $this->notificationsModel->send_Notification_to_my_followers($who_follows_me, "check who posted a post!, one you follow!");

    }

    public function notificate_author_for_like($post_id)
    {
        $author_id = $this->postsModel->get_author_id($post_id);
        $author_id = $author_id['AUTHOR'];
        $this->notificationsModel->send_Notification_to_author($author_id, $post_id, "someone loved your post");
    }

    public function notificate_author_for_comments($post_id)
    {
        $author_id = $this->postsModel->get_author_id($post_id);
        $author_id = $author_id['AUTHOR'];
        $this->notificationsModel->send_Notification_to_author($author_id, $post_id, "someone commented on your post");
    }




}