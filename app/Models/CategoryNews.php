<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    use HasUuids;

    // Tentukan nama tabel jika berbeda dari konvensi
    protected $table = 'category_news';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'news_id', 
        'category_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
