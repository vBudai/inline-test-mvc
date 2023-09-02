<?php

use routing\Router;

try{
    require "vendor/autoload.php";
}
catch (Exception $e){
    echo "Composer autoload.php file error: " . $e->getMessage();
}

$router = new Router();
$router->parse();