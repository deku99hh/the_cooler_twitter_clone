<?php

namespace Controllers;

use Core\Controller;

use Models\stars;

use Contracts\StarsInterface;

class StarsController extends Controller{

    protected $starsModel;

    // public function __construct()
    // {
    //     $this->starsModel = new stars();
    // }
    public function __construct(
        StarsInterface $starsModel,
    ) {
        $this->starsModel = $starsModel;
    }

    public function star($post_id)
    {
        $stars_data = [
            'post_id' => $post_id,
            'user_id' => $_SESSION['user_info']['id'],
        ];

        $this->starsModel->toggle_star($stars_data);

        $route = str_replace('/the_cooler_twitter_clone/', '', parse_url($_SERVER['HTTP_REFERER'] ?? '', PHP_URL_PATH));

        $this->redirect( $route );

    }

    public function Stars()
    {
        $stars_data = [
            'user_id' => $_SESSION['user_info']['id'],
        ];

        $posts = $this->starsModel->getPostsWithMyStars($stars_data);

        $this->load('search', $posts);
    
    }

}