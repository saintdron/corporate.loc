<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\CommentRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

class ArticleController extends SiteController
{
    public function __construct(MenuRepository $m_rep, PortfolioRepository $p_rep, ArticleRepository $a_rep, CommentRepository $c_rep)
    {
        parent::__construct($m_rep);

        $this->template = 'articles';
        $this->bar = 'right';
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;
    }

    public function index($cat_alias = false)
    {
        $articles = $this->getArticles($cat_alias);
        $content = view(env('THEME') . '.articles_content')
            ->with('articles', $articles)
            ->render();
        $this->vars = array_add($this->vars, 'content_sect', $content);

        $this->formContentRightBar();

        return $this->renderOutput();
    }

    public function show($alias)
    {
        $article = $this->getArticle($alias);
//        dd($article->comments->groupBy('parent_id'));

        $content = view(env('THEME') . '.article_content')
            ->with('article', $article)
            ->render();
        $this->vars = array_add($this->vars, 'content_sect', $content);

        $this->formContentRightBar();

        return $this->renderOutput();
    }

    protected function getArticles($cat_alias = false)
    {
        $where = false;
        if ($cat_alias) {
            $id = Category::select('id')->where('alias', $cat_alias)->first()->id;
            $where = ['category_id', $id];
        }

        $articles = $this->a_rep->get(['id', 'title', 'text', 'desc', 'alias', 'img', 'created_at', 'user_id', 'category_id'], false, true, $where);
        return $articles;
    }

    protected function getArticle($alias)
    {
        $article = $this->a_rep->one($alias);
        return $article;
    }

    protected function formContentRightBar()
    {
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('THEME') . '.articlesBar')
            ->with(['comments' => $comments, 'portfolios' => $portfolios]);
    }

    protected function getComments($take)
    {
        $comments = $this->c_rep->get(['name', 'email', 'text', 'site', 'article_id', 'user_id'], $take);
        if ($comments) {
            $comments->load('article', 'user');
        }
        return $comments;
    }

    protected function getPortfolios($take)
    {
        $portfolios = $this->p_rep->get(['title', 'text', 'alias', 'customer', 'img', 'filter_alias'], $take);
        return $portfolios;
    }
}
