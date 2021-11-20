<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Get the order client.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\User');
    }


    /**
     * Get the order status.
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }


    /**
     * Get the order products.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot(['product_qty']);
    }

    /**
     * Get the order delivery.
     */
    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'total',
        'status_id',
        'address',
        'city',
        'phone',
        'cashback'
    ];

}
