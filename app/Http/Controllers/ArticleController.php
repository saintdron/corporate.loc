<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\ArticleRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

class ArticleController extends SiteController
{
    public function __construct(MenuRepository $m_rep, PortfolioRepository $p_rep, ArticleRepository $a_rep)
    {
        parent::__construct($m_rep);

        $this->template = 'articles';
        $this->bar = 'right';
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
    }

    public function index()
    {
        $articles = $this->getArticles();

        return $this->renderOutput();
    }

    protected function getArticles($alias = false)
    {
        $articles = $this->a_rep->get(['title', 'text', 'desc', 'alias', 'img', 'created_at'], false, true);
//        dd($articles);
        if ($articles) {
            //$articles->load('categories', 'users', 'comments');
        }
        return $articles;
    }
}
