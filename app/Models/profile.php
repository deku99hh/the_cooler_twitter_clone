<?php

namespace Models;

use Core\QueryBuilder;
use Core\model;
use Contracts\ProfileInterface;

class profile extends model implements ProfileInterface{

    protected $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();
    }

    public function update($userId, $name, $links, $about_text, $birthday)
    {
        $columns = ['name', 'links', 'about_text', 'birthday'];
        $values  = [$name, $links, $about_text, $birthday];

        return $this->builder->WHERE(['user_id'], [$userId], ['='])
                    ->UPDATE('users', $columns, $values)
                    ->execute();
        }

}
