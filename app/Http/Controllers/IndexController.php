<?php

namespace Corp\Http\Controllers;

use Corp\Menu;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Corp\Repositories\SliderRepository;
use Illuminate\Http\Request;
use Config;


class IndexController extends SiteController
{
    public function __construct(SliderRepository $s_rep, PortfolioRepository $p_rep, ArticleRepository $a_rep)
    {
        parent::__construct(new MenuRepository(new Menu));

        $this->bar = 'right';
        $this->template = 'index';
        $this->s_rep = $s_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        $this->title = 'Home Page';

        $portfolio = $this->getPortfolio();
        $content_sect = view(env('THEME') . '.content')
            ->with('portfolio', $portfolio)
            ->render();

        $slider_sect = view(env('THEME') . '.slider')
            ->with('slider', $this->getSlider())
            ->render();

        $articles = $this->getArticles();
        $this->contentRightBar = view(env('THEME') . '.indexBar')
            ->with('articles', $articles)
            ->render();

        $this->vars = array_merge($this->vars, [
            'slider_sect' => $slider_sect,
            'content_sect' => $content_sect
        ]);
        return $this->renderOutput();
    }

    protected function getArticles()
    {
        $articles = $this->a_rep->get(['title', 'img', 'created_at', 'alias'], Config::get('settings.home_articles_count'));
        return $articles;
    }

    protected function getPortfolio()
    {
        $portfolio = $this->p_rep->get('*', Config::get('settings.home_portfolio_count'));
        return $portfolio;
    }

    protected function getSlider()
    {
        $slider = $this->s_rep->get();

        if ($slider->isEmpty()) {
            return false;
        }

        $slider->transform(function ($item) {
            $item->img = Config::get('settings.slider_path') . '/' . $item->img;
            return $item;
        });
        return $slider;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
