<?php

namespace Corp;

use Corp\Traits\DataTrait;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use DataTrait;

    public function filter()
    {
        return $this->belongsTo('Corp\Filter', 'filter_alias', 'alias');
    }

    public function getTextAttribute($value)
    {
        return str_replace(["\\r\\n", "\\r", "\\n"], " ", $value);
    }
}
