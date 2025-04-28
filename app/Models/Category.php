<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
    ];

    protected $table = 'categories';

    public function news()
    {
        return $this->belongsToMany(News::class, 'category_news', 'category_id', 'news_id');
    }
}
