<?php

namespace App\Models;

class Transfer extends Model
{
    protected $fillable = ['alipay', 'amount'];

    public function user(){
        $this->belongsTo(User::class);
    }
}
