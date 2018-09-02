<?php

namespace Corp;

use Corp\Traits\DataTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use DataTrait;

    protected $fillable = ['name', 'email', 'text', 'site', 'user_id', 'article_id', 'parent_id'];

    public function article()
    {
        return $this->belongsTo('Corp\Article');
    }

    public function user()
    {
        return $this->belongsTo('Corp\User');
    }
}
