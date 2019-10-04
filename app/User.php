<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

//const ADMIN_TYPE = 'admin';
//const DEFAULT_TYPE = 'default';

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['profileLink'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //public function post()
    //{
    //    return $this->belongsToMany('App\Post', 'id');
    //}

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getProfileLinkAttribute()
    {
        return route('user.show', $this);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function isNot($user)
    {
        return $this->id !== $user->id;
    }

    public function isFollowing($user)
    {
        return (bool) $this->following->where('id', $user->id)->count();
    }

    public function canFollow($user)
    {
        if (!$this->isNot($user)) {
            return false;
        }
        return !$this->isFollowing($user);
    }

    public function canUnFollow($user)
    {
        return $this->isFollowing($user);
    }

    public function admin(User $user) {
        return (bool) $user->isAdmin;
    }


}
