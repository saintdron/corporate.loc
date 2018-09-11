<?php

namespace Corp\Http\Controllers\Admin;

use Menu;
use Gate;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    protected $m_rep;

    public function __construct(MenuRepository $m_rep, ArticleRepository $a_rep, PortfolioRepository $p_rep)
    {
        parent::__construct();

        $this->m_rep = $m_rep;
        $this->a_rep = $a_rep;
        $this->p_rep = $p_rep;

        $this->template = 'admin.general';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view', new \Corp\Menu())) {
            abort(403);
        }

        $this->title = "Управление меню";

        $menus = $this->getMenus();
        $this->content_view = view(env('THEME') . '.admin.menus_content')
            ->with('menus', $menus)
            ->render();

        return $this->renderOutput();
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

    public function getMenus()
    {
        $menu = $this->m_rep->get(['id', 'title', 'path', 'parent_id']);

        if ($menu->isEmpty()) {
            return false;
        }

        return Menu::make('forMenusContent', function ($m) use ($menu) {
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
    }
}
