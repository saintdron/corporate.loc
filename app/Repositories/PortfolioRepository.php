<?php

namespace Corp\Repositories;

use Corp\Portfolio;


class PortfolioRepository extends Repository
{
    public function __construct(Portfolio $model)
    {
        $this->model = $model;
    }
}