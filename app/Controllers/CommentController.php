<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\posts;
use Models\comments;

use Controllers\NotificationsController;

class CommentController extends Controller{

    protected $postsModel;
    protected $commentsModel;
    
    protected $NotificationsController;

    public function __construct()
    {
        $this->postsModel = new posts();
        $this->commentsModel = new comments();

        $this->NotificationsController = new NotificationsController();
    }

    public function comment($post_id)
    {
        $post_data = $this->postsModel->get_post_by_id($post_id);
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

        $this->commentsModel->new_comment($comment_data);

        $this->NotificationsController->notificate_author_for_comments($post_id);

        $this->redirect("Post/open_post/" . $post_id);
    }

}
