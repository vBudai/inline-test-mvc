<?php

return [

    [
        'route' => '/',
        'controller' => 'SearchController',
        'action' => 'index',
        'page_method' => 'GET'
    ],

    [
        'route' => '/search',
        'controller' => 'SearchController',
        'action' => 'index',
        'page_method' => 'GET'
    ],

    [
        'route' => '/load',
        'controller' => 'LoadController',
        'action' => 'index',
        'page_method' => 'GET'
    ],

];