<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crude extends Model
{
    use HasFactory;

    /**
     * Get the crude unit.
     */
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }


    /**
     * Get the crude products.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'articul',
        'unit_id',
        'quantity',
        'price',
        'image',
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
}
