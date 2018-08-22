<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Menu;

class SiteController extends Controller
{
    protected $p_rep; // PortfoliosRepository
    protected $s_rep; // SlidersRepository
    protected $a_rep; // ArticlesRepository
    protected $m_rep; // MenuRepository

    protected $template; // the name of the returned template
    protected $vars = []; // list of variables to be passed to the template

    protected $bar = false; // whether the sidebar is enabled
    protected $contentLeftBar = null; // content of the left bar
    protected $contentRightBar = null; // content of the right bar

    public function __construct(MenuRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput()
    {
        $navigation = view(env('THEME') . '.navigation')
            ->with('menu', $this->getMenu())
            ->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);
        return view(env('THEME') . '.' . $this->template)
            ->with($this->vars);
    }

    protected function getMenu()
    {
        $menu = $this->m_rep->get();

        $mBuilder = Menu::make('MyNav', function ($m) use ($menu) {
            foreach ($menu as $item) {
                if ($item->parent_id === 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                }
            }
            foreach ($menu as $item) {
                if ($item->parent_id !== 0) {
                    $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                }
            }
        });

        return $mBuilder;
    }
}
