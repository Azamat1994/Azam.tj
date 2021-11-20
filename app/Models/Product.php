<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    /**
     * Get the product category.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Category', 'gender_id');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Category', 'color');
    }

    public function season()
    {
        return $this->belongsTo('App\Models\Category', 'season');
    }

    /**
     * Get the product orders.
     */
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\ProductSize');
    }


    /**
     * Get the product crudes.
     */
    public function crudes()
    {
        return $this->belongsToMany('App\Models\Crude')->withPivot('crude_qty', 'crude_price');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'articul',
        'description',
        'size',
        // 'width',
        // 'girth',
        'slug',
        'quantity',
        'image',
        'cost',
//        'markup',
        'price',
        'season',
        'color',
        'parent_id',
        'sale',
        'gender_id',
        'category_id',
        'is_active',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'array',
    ];

    public function parent() {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
