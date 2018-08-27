<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function formatDate()
    {
//        setlocale(LC_TIME, 'rus', 'ru', 'ru_RU', 'rus', 'Russian_ru', 'ru_RU.UTF-8', 'ru_RU.utf8', 'ru_RU.1251', 'ru_RU.cp1251', 'ru_Russian', 'ru_RU.utf-8', 'Russian_Russia.utf-8');
        $currentLocal = setlocale(LC_TIME, 0);
//        dd($currentLocal);
        $date = strftime('%d %B %Y', $this->created_at->format('U'));
        if (strpos($currentLocal, '1251') !== false) {
            $date = iconv("Windows-1251", "utf-8", $date);
        }
        $date .= ' года';
        return $date;
    }
}
