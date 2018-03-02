<?php

namespace App\Models;

class Book extends Model
{
    protected $fillable = ['sn', 'name', 'image', 'author', 'press', 'published_at', 'used', 'original_price', 'price', 'description', 'status', 'is_show', 'is_recommend', 'user_id', 'category_id', 'school_id', 'admin_id'];
}
