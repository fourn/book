<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccounts extends Model
{

    public $fillable = ['amount', 'user_id', 'user_balance', 'type', 'link'];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
        $accounts = array_pluck(config('custom.user.account'), 'name', 'id');
        return $accounts[$this->type];
    }

    public function getSymbolAttribute(){
        $accounts = array_pluck(config('custom.user.account'), 'symbol', 'id');
        return $accounts[$this->type];
    }
}
