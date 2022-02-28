<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'order_id', 'mode', 'status'];

    /**
     * transection with order one to one relation ship
     */
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
