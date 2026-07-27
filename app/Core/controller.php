<?php

namespace Core;

use Core\view;

class Controller 
{
    protected function redirectIfAuthenticated()
    {
        if (isset($_SESSION['user_info'])) {
            header("location: " . $_SESSION["BURL"]);
            exit();
        }
    }

    protected function redirectIfNotAuthenticated()
    {
        if (!isset($_SESSION['user_info'])) {
            header("location: " . $_SESSION["BURL"] . "login");
            exit();
        }
    }

    protected function requirePostMethod($redirectTo = "")
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            header("location: " . $_SESSION["BURL"] . $redirectTo);
            exit();
        }
    }

    protected function refreshPage()
    {
        header("Refresh:0");
        exit();
    }


    public function redirect($redirectTo = "")
    {
        header("location: " . $_SESSION["BURL"] . $redirectTo);
        exit();
    }


    protected function load($view_name, $view_data = [])
    {
        $file = dirname(__DIR__) . '/Views/' . $view_name . '.php';

        if (file_exists($file)) {
            $response = $this->prepairViewDataAndResponce($view_data);
            require($file);
        }
        else {
            echo "this view " . $view_name . " does not exsest";
        }
    }

    protected function prepairViewDataAndResponce($view_data = [])
    {
        $response = [ 
            'ok' => 1,
            'user_info' => isset($_SESSION['user_info']) ? $_SESSION['user_info'] : null,
        ];

        if (!empty($view_data)) {
            $result;
            foreach ($view_data as $key => $value) {
                $result['data'][$key] = $value;
            }
            $response = array_merge($response,$result);
        }


        return $response;
    }

}