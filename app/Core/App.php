<?php

namespace Core;

class App{

    protected $controller = "HomeController";
    protected $action = "index";
    protected $params=[];

    public function __construct(){
        $this->prepareURl();
        $this->render();
    }

    public function prepareURl() {

        
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if ($url) {
            
            $url = trim($url, "/");
            $url = explode('/',$url);
            unset($url[0]);
            $url = array_values($url);
            
            $this->controller = isset($url[0]) ? ucwords($url[0]). "Controller" : "HomeController";

            $this->action = isset($url[1]) ? $url[1] : "index";

            unset($url[0], $url[1]);

            $this->params = !empty($url) ? array_values($url) : [];
        }

        $this->controller = "Controllers\\" . $this->controller;
    }

    public function render(){
        if (class_exists($this->controller)) {
            // $controller = new ("\\" . ltrim($this->controller, "\\"));
            $controller = Container::resolve($this->controller);
            
            if (method_exists($controller, $this->action)) {
                
                call_user_func_array([$controller, $this->action], $this->params);

            }
            else {
                echo "this method " . $this->action . " does not exsest";
            }
        }
        else {
            echo "this controller " . $this->controller . " does not exsest";
        }
    }
}