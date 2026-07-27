<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\posts;
use Models\comments;

use Controllers\NotificationsController;

use Contracts\PostsInterface;
use Contracts\CommentsInterface;
use Contracts\NotificationsControllerInterface;

class CommentController extends Controller{

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


    public function comment($post_id)
    {
        $post_data = $this->postsModel->getPostById($post_id);
        $data['post_data'] = $post_data;
        $this->load('comment', $data);

    }

    public function makeNewComment($post_id)
    {
        $this->requirePostMethod("");
        $comment_text = $_POST['comment_text'];
        $comment_data = [
            'comments_text' => $comment_text,
            'user_id' => $_SESSION['user_info']['id'],
            'post_id' => $post_id
        ];

        $this->commentsModel->newComment($comment_data);

        $this->NotificationsController->notificateAuthorForComments($post_id);

        $this->redirect("Post/openPost/" . $post_id);
    }

}
