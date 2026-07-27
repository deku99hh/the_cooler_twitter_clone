<?php

namespace Controllers;

use Core\Controller;

use Models\posts;
use Models\comments;

use Controllers\NotificationsController;

use Contracts\NotificationsControllerInterface;
use Contracts\CommentsInterface;
use Contracts\PostsInterface;

class PostController extends Controller{

    protected $postsModel;
    protected $commentsModel;
    
    protected $NotificationsController;

    public function __construct(
        PostsInterface $postsModel,
        CommentsInterface $commentsModel,
        NotificationsControllerInterface $NotificationsController
    ) {
        $this->postsModel = $postsModel;
        $this->commentsModel = $commentsModel;
        $this->NotificationsController = $NotificationsController;
    }



    public function makeNewPost()
    {
        $this->requirePostMethod("");
        $post_text = $_POST['post_text'];
        $post_dsta = [
            'post_text' => $post_text,
            'user_id' => $_SESSION['user_info']['id'],
        ];

        $this->postsModel->newPost($post_dsta);
        
        $this->NotificationsController->notificateFollowersForPost($_SESSION['user_info']['id']);

        $this->refreshPage();

    }

    public function openPost($id)
    {
        $post_data = $this->postsModel->getPostById($id);
        $commentsArr = $this->commentsModel->getCommentsByPostId($id);

        $data = [ 
            'post_data' => $post_data,
            'commentsarr' => $commentsArr
        ];

        $this->load('post', $data);
    }


}
