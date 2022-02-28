<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rating', 'comment', 'order_item_id'];

    /**
     * review with order item one to one relation ship
     */
    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
}
