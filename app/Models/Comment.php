<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Get the comment product.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }


    /**
     * Get the comment user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'text',
    ];

}
