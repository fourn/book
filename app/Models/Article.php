<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $hidden = ['content'];

    public function scopeAlias($query, $alias){
        return $query->where('alias', 'like', '%'.$alias.'%')->orderBy('sort', 'asc');
    }

}
