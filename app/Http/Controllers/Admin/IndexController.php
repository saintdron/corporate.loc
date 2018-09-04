<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->template = 'admin.index';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Панель администратора';
                
        return $this->renderOutput();
    }
}
