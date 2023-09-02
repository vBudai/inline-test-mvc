<?php

namespace models;

use base\BaseModel;

class CommentModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'comments';
    }
}