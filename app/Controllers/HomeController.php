<?php

namespace Controllers;

use Core\Controller;

use Models\posts;

use Contracts\PostsInterface;

class HomeController extends Controller{

    protected $postsModel;
    
    // public function __construct()
    // {
    //     $this->postsModel = new posts();
    // }
    public function __construct(
        PostsInterface $postsModel,
    ) {
        $this->postsModel = $postsModel;
    }


    public function index(){

        $posts = $this->postsModel->get_posts();
        $data['posts'] = $posts;

        $this->load('home', $data);
    }

    public function following()
    {
        $this->redirectIfNotAuthenticated();
        $my_id = $_SESSION['user_info']['id'];

        $posts = $this->postsModel->get_posts_by_follows($my_id);
        $data['posts'] = $posts;
        
        $this->load('home', $data);
    }





}