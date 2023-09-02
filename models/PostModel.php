<?php

namespace models;

use base\BaseModel;

class PostModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'posts';
    }

}