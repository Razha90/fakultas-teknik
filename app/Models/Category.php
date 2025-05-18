<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Category extends Model
{
    //
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name'];

    protected $table = 'categories';

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'category_news', 'category_id', 'news_id');
    }

}
