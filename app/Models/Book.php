<?php

namespace App\Models;

class Book extends Model
{
    protected $fillable = ['sn', 'name', 'image', 'author', 'press', 'published_at', 'used', 'original_price', 'price', 'description', 'status', 'is_show', 'is_recommend', 'user_id', 'category_id', 'school_id', 'admin_id'];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    /**
     * cover used attribute for human read
     * @param $value
     * @return mixed
     */
    public function getUsedFormatAttribute(){
        $used_arr = config('custom.book.used');
        return $used_arr[$this->used];
    }

    public function getStatusNameAttribute(){
        $statuses = array_pluck(config('custom.book.status'), 'name', 'id');
        return $statuses[$this->status];
    }

    public function scopeOfSchool($query){
        return $query->where('school_id', session('school_id', 0));
    }

    public function scopeForUser($query){
        return $query->where('is_show', 1)->where('status', 2);
    }

    //是否可以被购买
    public function canBuy(){
        $statuses = array_pluck(config('custom.book.status'), 'canShow', 'id');
        return $statuses[$this->status];
    }

    public function payed(){
        $this->status = 4;
        $this->save();
    }
}
