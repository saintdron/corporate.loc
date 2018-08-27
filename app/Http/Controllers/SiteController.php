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

    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template; // the name of the returned template
    protected $vars = []; // list of variables to be passed to the template

    protected $bar = 'no'; // whether the sidebar is enabled
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
        $this->vars = array_add($this->vars, 'navigation_sect', $navigation);

        if ($this->contentRightBar) {
            $rightBar = view(env('THEME') . '.rightBar')
                ->with('content_rightBar', $this->contentRightBar)
                ->render();
            $this->vars = array_add($this->vars, 'rightBar_sect', $rightBar);
        }
        $this->vars = array_add($this->vars, 'bar', $this->bar);

        $footer = view(env('THEME') . '.footer')
            ->render();
        $this->vars = array_add($this->vars, 'footer_sect', $footer);

        $this->vars = array_merge($this->vars, [
            'keywords' => $this->keywords,
            'meta_desc' => $this->meta_desc,
            'title' => $this->title
        ]);

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
