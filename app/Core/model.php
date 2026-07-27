<?php

namespace Core;

use Core\QueryBuilder;

class model{

    public $db;

    public function __construct(){
        $this->db = new QueryBuilder();
    }

}