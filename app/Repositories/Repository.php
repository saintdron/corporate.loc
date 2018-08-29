<?php

namespace Corp\Repositories;

use Config;
use Illuminate\Support\Collection;

abstract class Repository
{
    protected $model = null;

    public function get($select = '*', $take = false, $pagination = false, $where = false)
    {
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        if ($where) {
            $builder->where($where[0], $where[1]);
        }

        if ($pagination) {
            return $this->check($builder->paginate(Config::get('settings.articles_paginate')));
        }

        return $this->check($builder->get());
    }

    public function one($alias, $select = '*')
    {
        $result = $this->model->select($select)->where('alias', $alias)->first();

        $this->imgDecode($result);

        return $result;
    }

    protected function check($result)
    {
        if ($result->isEmpty()) {
            return false;
        }

        $result->transform(function ($item) {
            return $this->imgDecode($item);
        });

        return $result;
    }

    protected function imgDecode($item) {
        if (is_string($item->img) && is_object(json_decode($item->img)) && json_last_error() === JSON_ERROR_NONE) {
            $item->img = json_decode($item->img);
        }
        return $item;
    }
}