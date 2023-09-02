<?php

namespace views;


use base\BaseView;

class SearchView extends BaseView
{

    public function showSearchPage(array $data = [])
    {
        $data =  json_encode($data, JSON_PRETTY_PRINT);
        require $_SERVER['DOCUMENT_ROOT'] . '/templates/search_page.php';
    }

}