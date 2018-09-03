<?php

namespace Corp\Repositories;

use Corp\Portfolio;


class PortfolioRepository extends Repository
{
    public function __construct(Portfolio $model)
    {
        $this->model = $model;
    }

    public function get($select = '*', $take = false, $pagination = false, $where = false)
    {
        $portfolios = parent::get($select, $take, $pagination, $where);
        if ($portfolios) {
            $portfolios->load('filter');
        }
        return $portfolios;
    }
}