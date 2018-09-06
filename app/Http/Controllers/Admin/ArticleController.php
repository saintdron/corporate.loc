<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends AdminController
{
    public function __construct(ArticleRepository $a_rep)
    {
        parent::__construct();

        $this->a_rep = $a_rep;
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

    public function getArticles()
    {
        return $this->a_rep->get();
    }
}
