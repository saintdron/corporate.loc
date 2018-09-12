<?php

namespace Corp\Repositories;

use Corp\Menu;
use Illuminate\Support\Facades\Gate;

class MenuRepository extends Repository
{
    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function addMenu($request)
    {
        if (Gate::denies('create', $this->model)) {
            abort(403);
        }

        $data = $request->only('type', 'title', 'parent_id');
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        switch ($data['type']) {
            case 'customLink':
                $data['path'] = $request->input('custom_link');
                break;
            case 'blogLink':
                if ($request->input('category_alias')) {
                    if ($request->input('category_alias') === 'parent') {
                        $data['path'] = route('articles.index');
                    } else {
                        $data['path'] = route('articlesCat', ['cat_alias' => $request->input('category_alias')]);
                    }
                } else if ($request->input('article_alias')) {
                    $data['path'] = route('articles.show', ['alias' => $request->input('article_alias')]);
                }
                break;
            case 'portfolioLink':
                if ($request->input('filter_alias')) {
                    if ($request->input('category_alias') === 'parent') {
                        $data['path'] = route('portfolios.index');
                    } else {
                        // Отображение всех портфолио по указанному фильтру 'filter_alias'
                    }
                } else if ($request->input('portfolio_alias')) {
                    $data['path'] = route('portfolios.show', ['alias' => $request->input('portfolio_alias')]);
                }
                break;
            default:
                return ['error' => 'Не выбран путь для нового пункта меню'];
        }

        unset($data['type']);

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Новый пункт меню добавлен'];
        } else {
            return ['error' => 'Не удалось добавить пункт меню'];
        }
        //dd($data);
    }
}