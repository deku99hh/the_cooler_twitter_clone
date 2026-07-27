<?php

namespace Controllers;

use Core\Controller;

use Models\user;
use Models\follows;
use Models\profile;

use Contracts\UserInterface;
use Contracts\FollowsInterface;
use Contracts\ProfileInterface;

class ProfileController extends Controller{

    protected $userModel;
    protected $followsModel;
    protected $profileModel;

    public function __construct(
        UserInterface $userModel,
        FollowsInterface $followsModel,
        ProfileInterface $profileModel
    ) {
        $this->userModel = $userModel;
        $this->followsModel = $followsModel;
        $this->profileModel = $profileModel;
    }


    public function index()
    {
        $this->redirectIfNotAuthenticated();

        $my_id = $_SESSION['user_info']['id'];

        $user_data = $this->userModel->get_user_data($_SESSION['user_info']['username']);

        $num_who_follows_A = $this->followsModel->get_follows_num($my_id);
        $num_who_A_is_following = $this->followsModel->get_followeds_num($my_id);
        
        $data = [ 
            'user_data' => $user_data,
            'num_who_follows_A' => $num_who_follows_A,
            'num_who_A_is_following' => $num_who_A_is_following,
            'userIsME' => 1
        ];

        $this->load('Profile', $data);
    }

    public function openProfile($user_id)
    {
        $doIFollowHem = null;
        if (!empty($_SESSION['user_info'])) {
            $doIFollowHem = $this->followsModel->doIFollowHem($user_id);
        }

        $user_data = $this->userModel->get_user_data_by_id($user_id);

        $num_who_follows_A = $this->followsModel->get_follows_num($user_id);
        $num_who_A_is_following = $this->followsModel->get_followeds_num($user_id);
        $profile = [
            'num_who_follows_A' => $num_who_follows_A,
            'num_who_A_is_following' => $num_who_A_is_following,
            'user_data' => $user_data,
            "user_id" => $user_id,
            'doIFollowHem' => $doIFollowHem,
            'userIsME' => 0
        ];
        
        $this->load('Profile', $profile);
    }

    public function edit()
    {
        $this->redirectIfNotAuthenticated();

        $data['userdata'] = $this->userModel->get_user_data_by_id($_SESSION['user_info']['id']);
        $this->load('editProfile', $data);
    }

    public function update()
    {
        $name = $_POST['name'];
        $links = $_POST['links'];
        $about_text = $_POST['about_text'];
        $birthday = $_POST['birthday'];

        $this->profileModel->update($_SESSION['user_info']['id'], $name, $links, $about_text, $birthday);
        
        $this->redirect("Profile");
    }
}