<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Article;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends AdminController
{
    public function __construct(ArticleRepository $a_rep, CategoryRepository $cat_rep)
    {
        parent::__construct();

        $this->a_rep = $a_rep;
        $this->cat_rep = $cat_rep;
        $this->template = 'admin.articles';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_ARTICLES')) {
            abort(403);
        }

        $this->title = "Управление статьями";

        $articles = $this->getArticles();
        $this->content_view = view(env('THEME') . '.admin.articles_content')
            ->with('articles', $articles)
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
        if (Gate::denies('create', new Article())) {
            abort(403);
        }

        $this->title = "Добавление нового материала";

        $categories = $this->getCategories();
        $list = [];
        foreach ($categories as $category) {
            if ($category->parent_id === 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }

        $this->content_view = view(env('THEME') . '.admin.articles_edit_content')
            ->with('categories', $list)
            ->render();

        return $this->renderOutput();
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

    public function getArticles()
    {
        return $this->a_rep->get();
    }

    public function getCategories()
    {
        return $this->cat_rep->get(['title', 'alias', 'parent_id', 'id']);
    }
}
