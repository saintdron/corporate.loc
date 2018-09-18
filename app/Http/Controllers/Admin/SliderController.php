<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\SliderRequest;
use Corp\Repositories\SliderRepository;
use Corp\Slider;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SliderController extends AdminController
{
    public function __construct(SliderRepository $s_rep)
    {
        parent::__construct();

        $this->s_rep = $s_rep;
        $this->template = 'admin.general';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view', new Slider())) {
            abort(403);
        }

        $this->title = "Управление слайдом";

        $sliders = $this->getSliders();
//        dd($sliders);
        $this->content_view = view(config('settings.theme') . '.admin.sliders_content')
            ->with('sliders', $sliders)
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
        if (Gate::denies('create', new Slider())) {
            abort(403);
        }

        $this->title = "Добавление нового слайда";

        $this->content_view = view(config('settings.theme') . '.admin.sliders_edit_content')
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $result = $this->s_rep->addSlider($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        if (Gate::denies('update', $slider)) {
            abort(403);
        }

        $this->title = "Редактирование материала – №" . $slider->id;

        $this->content_view = view(config('settings.theme') . '.admin.sliders_edit_content')
            ->with('slider', $slider)
            ->render();
//        dd($slider);
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSliders(){
        return $this->s_rep->get(['id', 'img', 'desc', 'title']);
    }
}
