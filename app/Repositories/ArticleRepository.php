<?php

namespace Corp\Repositories;

use Corp\Article;
use Corp\Http\Requests\ArticleRequest;
use Gate;
use Intervention\Image\Facades\Image;

class ArticleRepository extends Repository
{
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function get($select = '*', $take = false, $pagination = false, $where = false)
    {
        $articles = parent::get($select, $take, $pagination, $where);
        if ($articles) {
            $articles->load('category', 'user', 'comments');
        }
        return $articles;
    }

    public function one($alias, $select = '*', $needLoad = true)
    {
        $article = parent::one($alias, $select);
        if ($article && $needLoad) {
            $article->load('category', 'user', 'comments');
            $article->comments->load('user');
        }
        return $article;
    }

    public function addArticle(ArticleRequest $request)
    {
        if (Gate::denies('create', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', 'image');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        } else {
            $data['alias'] = $this->transliterate($data['alias']);
        }

        if (empty($data['desc'])) {
            $data['desc'] = '<p>' . str_limit(strip_tags($data['text']), config('settings.articles_desc_length')) . '</p>';
        }

        if ($this->one($data['alias'], ['alias'], false)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();
            return ['error' => 'Данный псевдоним уже используется'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $str = str_random(8);
                $obj = new \stdClass();
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';

                $img = Image::make($image);
                $img->fit(config('settings.image')['width'], config('settings.image')['height'])
                    ->save(public_path() . '/' . env('THEME') . '/images/' . config('settings.articles_path') . '/' . $obj->path);
                $img->fit(config('settings.articles_img')['max']['width'], config('settings.articles_img')['max']['height'])
                    ->save(public_path() . '/' . env('THEME') . '/images/' . config('settings.articles_path') . '/' . $obj->max);
                $img->fit(config('settings.articles_img')['mini']['width'], config('settings.articles_img')['mini']['height'])
                    ->save(public_path() . '/' . env('THEME') . '/images/' . config('settings.articles_path') . '/' . $obj->mini);

                $data['img'] = json_encode($obj);
            }
        }

        $this->model->fill($data);

        if ($request->user()->articles()->save($this->model)) {
            return ['status' => 'Материал добавлен'];
        } else {
            return ['error' => 'Не удалось сохранить материал'];
        }
    }
}