<?php

namespace Controllers;

use Core\Controller;
use Services\AuthService;

use Models\user;

use Contracts\AuthServiceInterface;
use Contracts\UserInterface;

class SignupController extends Controller{

    protected $AuthService;
    protected $userModel;

    public function __construct(
        AuthServiceInterface $AuthService,
        UserInterface $userModel,
    ) {
        $this->AuthService = $AuthService;
        $this->userModel = $userModel;
    }

    public function index(){
        $this->redirectIfAuthenticated();
        $this->load('signup');
    }

    public function signup(){
        $this->requirePostMethod("signup");
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        $email = $_POST["email"];
        $name = $_POST["name"];

        $errors = $this->AuthService->validateSignup($username, $pwd, $email);

        if ($errors) {
            $_SESSION['errors_signup'] = $errors;

            $user_data = $this->userModel->getUserDataByUsername($username);
            $signupData = [
                "username" => $username,
                "email" => $email,
                "name" => $name,
            ];
            $_SESSION['signupData'] = $signupData;

            $this->redirect("signup");
        }

        $this->userModel->creatUser($username, $name, $pwd, $email);
        
        $user_data = $this->userModel->getUserDataByUsername($username);
        $_SESSION['user_info'] = [
            'id' => $user_data['id'],
            'username' => $user_data['username'],
            'email' => $user_data['email'],
            'verified' => $user_data['verified'],
            'name' => $user_data['name'],
        ];
        
        $this->redirect("");

    }
}