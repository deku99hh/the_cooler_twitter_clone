<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\user;
use Models\val;

use Contracts\AuthServiceInterface;
use Contracts\UserInterface;

class LoginController extends Controller{

    protected $AuthService;
    protected $userModel;


    // public function __construct(){
    //     $this->AuthService = new AuthService();
    //     $this->userModel = new user();
    //     // $this->validationModel = new val();
    // }
    public function __construct(
        AuthServiceInterface $AuthService,
        UserInterface $userModel
    ) {
        $this->AuthService = $AuthService;
        $this->userModel = $userModel;
    }


    public function index(){
        $this->redirectIfAuthenticated();
        $this->load('login');
    }

    public function login() {
        $this->requirePostMethod("login");

        $username = $_POST["username"] ?? '';
        $pwd = $_POST["pwd"] ?? '';

        $errors = $this->AuthService->validateLogin($username, $pwd);

        if ($errors) {
            $_SESSION['errors_login'] = $errors;

            
            $this->redirect("login");
        }
        else {
            $user_data = $this->userModel->get_user_data($username);
            $_SESSION['user_info'] = [
                'id' => $user_data['user_id'],
                'username' => $user_data['username'],
                'email' => $user_data['email'],
                'verified' => $user_data['verified'],
                'name' => $user_data['name'],
            ];

            $this->redirect("");
        }
            
    }
}