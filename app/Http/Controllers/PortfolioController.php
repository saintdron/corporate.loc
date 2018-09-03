<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

class PortfolioController extends SiteController
{
    public function __construct(MenuRepository $m_rep, PortfolioRepository $p_rep)
    {
        parent::__construct($m_rep);

        $this->template = 'portfolios';
        $this->p_rep = $p_rep;
    }

    public function index()
    {
        $this->title = 'Портфолио';
        $this->keywords = 'Портфолио_ключи';
        $this->meta_desc = 'Портфолио_описание';

        $portfolios = $this->getPortfolios();
        $content = view(env('THEME') . '.portfolios_content')
            ->with('portfolios', $portfolios)
            ->render();
        $this->vars = array_add($this->vars, 'content_view', $content);

        return $this->renderOutput();
    }

    protected function getPortfolios()
    {
        return $this->p_rep->get(['title', 'text', 'alias', 'customer', 'img', 'filter_alias', 'created_at'], false, true);
    }
}
