<?php

namespace Controllers;

use Core\Controller;

use Models\user;
use Models\follows;

class FollowsController extends Controller{

    protected $userModel;
    protected $followsModel;

    public function __construct(){
        $this->userModel = new user();
        $this->followsModel = new follows();
    }

    public function followTo($user_id)
    {
        $this->followsModel->followTo($user_id);

        $route = str_replace('/the_cooler_twitter_clone/', '', parse_url($_SERVER['HTTP_REFERER'] ?? '', PHP_URL_PATH));
        $this->redirect( $route );
    }

    public function unfollowTo($user_id)
    {
        $this->followsModel->unfollowTo($user_id);

        $route = str_replace('/the_cooler_twitter_clone/', '', parse_url($_SERVER['HTTP_REFERER'] ?? '', PHP_URL_PATH));
        $this->redirect( $route );
    }

}