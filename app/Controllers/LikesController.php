<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\likes;

use Controllers\NotificationsController;

use Contracts\LikesInterface;
use Contracts\NotificationsControllerInterface;

class likesController extends Controller{

    protected $likesModel;

    protected $NotificationsController;

    public function __construct(
        LikesInterface $likesModel,
        NotificationsControllerInterface $NotificationsController
    ) {
        $this->likesModel = $likesModel;
        $this->NotificationsController = $NotificationsController;
    }


    public function like($post_id)
    {
        $this->likesModel->toggleLike($post_id, $_SESSION['user_info']['id']);

        $this->NotificationsController->notificateAuthorForLike($post_id);

        $route = str_replace('/the_cooler_twitter_clone/', '', parse_url($_SERVER['HTTP_REFERER'] ?? '', PHP_URL_PATH));

        $this->redirect( $route );
    }

}