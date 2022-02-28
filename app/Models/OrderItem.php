<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'order_id', 'price', 'quantity', 'rstatus'];

    /**
     * order item as only one order
     */
    public function order(){
        return $this->belongsTo(Order::class);
    }

    /**
     * order item with product table one to one relationship
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * one to one relationship with review table
     */
    public function review(){
        return $this->hasOne(Review::class);
    }
}
