<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use URL;

class Article extends Model
{

    protected $hidden = ['content'];

    public function scopeAlias($query, $alias){
        return $query
            ->where('alias', 'like', '%'.$alias.'%')
            ->where('is_show', 1)
            ->orderBy('sort', 'asc');
    }

    public function getLinkAttribute($key)
    {
        if($key === 0){
            return 'javascript:void(0);';
        }

        if(URL::isValidUrl($key)){
            return $key;
        }else{
            return route('article.show', $this);
        }
    }



}
