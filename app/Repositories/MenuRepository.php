<?php

namespace Corp\Repositories;

use Corp\Menu;

class MenuRepository extends Repository
{
    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
}