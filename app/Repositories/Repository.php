<?php

namespace Corp\Repositories;

use Config;

abstract class Repository
{
    protected $model = null;

    public function get($select = '*', $take = false, $pagination = false)
    {
        $builder = $this->model->select($select);
        if ($take) {
            $builder->take($take);
        }

        if($pagination) {
            return $this->check($builder->paginate(Config::get('settings.articles_paginate')));
        }
        return $this->check($builder->get());
    }

    protected function check($result)
    {
        if ($result->isEmpty()) {
            return false;
        }

        $result->transform(function ($item) {
            if (is_string($item->img) && is_object(json_decode($item->img)) && json_last_error() === JSON_ERROR_NONE) {
                $item->img = json_decode($item->img);
            }
            return $item;
        });

        return $result;
    }
}