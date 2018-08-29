<?php

namespace Corp\Repositories;

use Corp\Article;

class ArticleRepository extends Repository
{
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function get($select = '*', $take = false, $pagination = false, $where = false)
    {
        $articles = parent::get($select, $take, $pagination, $where);
        if ($articles) {
            $articles->load('category', 'user', 'comments');
        }
        return $articles;
    }

    public function one($alias, $select = '*') {
        $article = parent::one($alias, $select);
        if ($article) {
            $article->load('category', 'user', 'comments');
            $article->comments->load('user');
        }
        return $article;
    }
}