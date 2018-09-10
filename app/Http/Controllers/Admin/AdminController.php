<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Menu;

class AdminController extends Controller
{
    protected $p_rep;
    protected $a_rep;
    protected $cat_rep;
    protected $user;
    protected $template;
    protected $content_view = false;
    protected $title;
    protected $vars = [];

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();
        $menu_view = view(env('THEME') . '.admin.menu')
            ->with('menu', $menu)
            ->render();
        $this->vars = array_add($this->vars, 'menu_view', $menu_view);

        if ($this->content_view) {
            $this->vars = array_add($this->vars, 'content_view', $this->content_view);
        }

        $footer_view = view(env('THEME') . '.footer')
            ->render();
        $this->vars = array_add($this->vars, 'footer_view', $footer_view);

        return view(env('THEME') . '.' . $this->template)
            ->with($this->vars);
    }

    public function getMenu()
    {
        return Menu::make('adminMenu', function ($menu) {
            $menu->add('Статьи', ['route' => 'admin.articles.index']);
            $menu->add('Портфолио', ['route' => 'admin.articles.index']);
            $menu->add('Меню', ['route' => 'admin.articles.index']);
            $menu->add('Пользователи', ['route' => 'admin.articles.index']);
            $menu->add('Привилегии', ['route' => 'admin.permissions.index']);
        });
    }
}
