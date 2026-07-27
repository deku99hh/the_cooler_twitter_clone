<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\likes;

use Controllers\NotificationsController;

class likesController extends Controller{

    protected $likesModel;

    protected $NotificationsController;

    public function __construct()
    {
        $this->likesModel = new likes();

        $this->NotificationsController = new NotificationsController();
    }

    public function like($post_id)
    {
        // $this->requirePostMethod("");
        $this->likesModel->toggle_like($post_id, $_SESSION['user_info']['id']);

        $this->NotificationsController->notificate_author_for_like($post_id);

        $route = str_replace('/the_cooler_twitter_clone/', '', parse_url($_SERVER['HTTP_REFERER'] ?? '', PHP_URL_PATH));

        $this->redirect( $route );
    }

}