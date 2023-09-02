<?php

namespace routing;

use controllers\SearchController;
use Exception;

class Router
{

    private array $routes = [];

    public function __construct()
    {
        try{
            $this->routes = require $_SERVER['DOCUMENT_ROOT'] . '/config/routes.php';
        }
        catch (Exception $e){
            echo "Load routes.php file error: " . $e->getMessage();
        }
    }

    public function parse(): void
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = parse_url($url)['path']; // Отделение get-параметров
        $pageMethod = $_SERVER['REQUEST_METHOD'];
        $matches = null;

        $controllerName = null;
        $action = null;

        foreach ($this->routes as $route){
            if (preg_match('#^' . $route['route'] . '$#', $url, $matches)) {
                if($route['page_method'] != $pageMethod){
                    die("404");
                }
                $controllerName = 'controllers\\'.$route['controller'];
                $action = $route['action'];

                break;
            }
        }

        if($matches == null){
            die("404");
        }
        else{
            $controller = new $controllerName();
            $controller->$action();
        }
    }



}