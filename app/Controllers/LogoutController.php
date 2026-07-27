<?php

namespace Controllers;

use Core\Controller;

class LogoutController extends Controller{
    
    public function index()
    {
        unset($_SESSION['user_info']);
        $this->redirect("");
    }
}