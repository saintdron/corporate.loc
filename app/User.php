<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('Corp\Article');
    }

    public function comments()
    {
        return $this->hasMany('Corp\Comment');
    }

    public function roles()
    {
        return $this->belongsToMany('Corp\Role', 'user_role');
    }

    public function canDo($permission, $requireAll = false)
    {
        if (is_array($permission)) {
            dump($permission);
        } else {
            foreach ($this->roles as $role) {
                foreach ($role->permissions as $perm) {
                    if (str_is($permission, $perm->name)) {
                        return true;
                    }
                }
            }
        }
    }
}
