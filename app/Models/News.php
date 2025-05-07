<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'views',
        'image'
    ];
    
    protected $table = 'news';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_news', 'news_id', 'category_id');
    }
}
