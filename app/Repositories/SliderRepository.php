<?php

namespace Corp\Repositories;

use Corp\Http\Requests\SliderRequest;
use Corp\Slider;
use Gate;
use Image;

class SliderRepository extends Repository
{
    public function __construct(Slider $model)
    {
        $this->model = $model;
    }

    public function addSlider($request)
    {
        if (Gate::denies('create', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', 'image');
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        $image = $this->saveImage($request);
        if ($image) {
            $data['img'] = $image;
        } else {
            return ['error' => 'Не удалось сохранить картинку'];
        }

        $this->model->fill($data);

        if ($this->model->save($data)) {
            return ['status' => 'Слайд добавлен'];
        } else {
            return ['error' => 'Не удалось сохранить слайд'];
        }
    }

    public function saveImage($request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $name = str_random(8) . '.jpg';

                Image::make($image)->fit(config('settings.slider_img')['width'], config('settings.slider_img')['height'])
                    ->save(public_path() . '/' . config('settings.theme') . '/images/' . config('settings.slider_path') . '/' . $name);

                return $name;
            }
        }
        return null;
    }
}