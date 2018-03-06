<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name', 'depot'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function setSchoolLink(){
        return route('setSchool', ['id'=>$this->id]);
    }
}
