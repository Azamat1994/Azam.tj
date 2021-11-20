<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_desc',
        'image',
        'user_id',
        'link',
        'is_active',
    ];

    protected $casts = [
        'image'=> 'array'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
