<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'subtotal', 'discount', 'tax', 'total', 'firstname', 'lastname', 'mobile', 'email', 'line1', 'line2', 'city', 'province', 'country', 'zipcode', 'status', 'is_shipping_different', 'delivered_date', 'cancel_date'];

    /**
     * order related to one user
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * one order hay many items
     */
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    /**
     * one order has only one shipping
     */
    public function shipping(){
        return $this->hasOne(Shipping::class);
    }

    /**
     * one to one relationship with transection
     */
    public function transection(){
        return $this->hasOne(Transection::class);
    }

    private $order = array('orders.id' => 'desc');
    private $column_order;

    private $order_id;
    private $mobile;
    private $email;
    private $status;

    public function setOrderId($order_id){
        $this->order_id = $order_id;
    }

    public function setMobile($mobile){
        $this->mobile = $mobile;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setStatus($status){
        $this->status = $status;
    }


    private $orderValue;
    private $dirValue;
    private $startValue;
    private $lengthValue;


    /**
     * set order value
     */
    public function setOrderValue($orderValue){
        $this->orderValue = $orderValue;
    }

    /**
     * set order direction
     */
    public function setDirValue($dirValue){
        $this->dirValue = $dirValue;
    }

    /**
     * set limit
     */
    public function setLengthValue($lengthValue){
        $this->lengthValue = $lengthValue;
    }

    /**
     * set start
     */
    public function setStartValue($startValue){
        $this->startValue = $startValue;
    }

    /**
     * get all orders data
     */
    public function get_datatable_query(){

        $this->column_order = ['', 'orders.id', '', 'orders.user_id', 'orders.subtotal', 'orders.tax', 'orders.total', 'orders.mobile', 'orders.email', 'orders.created_at', '', ''];

        $query = self::with('user:id,name');

        if(!empty($this->order_id)){
            $query->where('id', $this->order_id);
        }

        if(!empty($this->mobile)){
            $query->where('mobile', 'like', '%'.$this->mobile.'%');
        }

        if(!empty($this->email)){
            $query->where('email', 'like', '%'.$this->email.'%');
        }

        if(!empty($this->status)){
            $query->where('status', $this->status);
        }

        if(isset($this->orderValue) && isset($this->dirValue)){
            $query->orderBy($this->column_order[$this->orderValue], $this->dirValue);
        }else if(isset($this->order)){
            $query->orderBy(key($this->order), $this->order[key($this->order)]);
        }
        return $query;
    }

    /**
     * get query list with start and limit
     */
    public function getList()
    {
        $query = $this->get_datatable_query();
        if ($this->lengthValue != -1) {
            $query->offset($this->startValue)->limit($this->lengthValue);
        }
        return $query->get();
    }

    /**
     * count filtered  items
     */
    public function count_filtered(){
        $query = $this->get_datatable_query();
        return $query->get()->count();
    }

    /**
     * count total orders
     *
     */
    public function count_all(){
        return self::toBase()->get()->count();
    }

}
