<?php

namespace Core;

use Core\QueryBuilder;

class model{

    private $db;

    public function __construct(){
        $this->db = new QueryBuilder();
    }

}