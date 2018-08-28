<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function formatCreatedAtDate($template)
    {
        $currentLocal = setlocale(LC_TIME, 0);
        $newLocal = setlocale(LC_TIME, 'rus', 'ru', 'ru_RU', 'rus', 'Russian_ru', 'ru_RU.UTF-8', 'ru_RU.utf8', 'ru_RU.1251', 'ru_RU.cp1251', 'ru_Russian', 'ru_RU.utf-8', 'Russian_Russia.utf-8');
//        dd($newLocal);
        $date = strftime($template, $this->created_at->format('U'));
        if (strpos($newLocal, '1251') !== false) {
            $date = iconv("Windows-1251", "utf-8", $date);
        }
        setlocale(LC_TIME, $currentLocal);
        return $date;
    }

    public function user()
    {
        return $this->belongsTo('Corp\User');
    }

    public function category()
    {
        return $this->belongsTo('Corp\Category');
    }

    public function comments()
    {
        return $this->hasMany('Corp\Comment');
    }


}