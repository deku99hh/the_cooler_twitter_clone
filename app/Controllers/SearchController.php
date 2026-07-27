<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\search;

use Contracts\SearchInterface;

class SearchController extends Controller{

    protected $searchModel;

    public function __construct(
        SearchInterface $searchModel,
    ) {
        $this->searchModel = $searchModel;
    }

    public function searchRedirect()
    {
        $key_words = $_POST['keyWords'];
        $this->redirect("search/search/" . $key_words);
    }

    public function search($key_words)
    {
        $posts = $this->searchModel->search($key_words);

        $data['posts'] = $posts;

        $this->load('search', $data);
    }


}