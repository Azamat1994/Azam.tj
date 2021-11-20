<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;



    protected $fillable = [
        'size',
        'color',
        'quantity',
        'product_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
