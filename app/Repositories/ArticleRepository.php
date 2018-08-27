<?php

namespace Corp\Repositories;

use Corp\Article;

class ArticleRepository extends Repository
{
    public function __construct(Article $model)
    {
        $this->model = $model;
    }
}