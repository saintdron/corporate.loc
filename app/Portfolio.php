<?php

namespace Corp;

use Corp\Traits\DronTrait;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use DronTrait;

    public function filter()
    {
        return $this->belongsTo('Corp\Filter', 'filter_alias', 'alias');
    }

    public function getTextAttribute($value)
    {
        return str_replace(["\\r\\n", "\\r", "\\n"], " ", $value);
    }
}
