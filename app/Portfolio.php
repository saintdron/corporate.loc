<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function filter()
    {
        return $this->belongsTo('Corp\Filter', 'filter_alias', 'alias');
    }

    public function getTextAttribute($value)
    {
        return str_replace(["\\r\\n", "\\r", "\\n"], " ", $value);
    }
}
