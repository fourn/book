<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'password', 'alipay', 'last_actived_at', 'school_id', 'notification_count', 'balance', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'last_actived_at'
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function sellOrders(){
        return $this->hasMany(Order::class, 'seller_id');
    }

    public function isAuthOf($model){
        return $model->user_id == $this->id;
    }
}
