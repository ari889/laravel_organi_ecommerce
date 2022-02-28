<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'type', 'value', 'cart_value', 'expiry_date'];

    private $order = array('coupons.id' => 'desc');
    private $column_order;

    private $code;
    private $type;
    private $value;
    private $cart_value;
    private $expiry_date;

    public function setCode($code){
        $this->code = $code;
    }
    public function setType($type){
        $this->type = $type;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function setCartValue($cart_value){
        $this->cart_value = $cart_value;
    }

    public function setExpiryDate($expiry_date){
        $this->expiry_date = $expiry_date;
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
     * set dir value
     */
    public function setDirValue($dirValue){
        $this->dirValue = $dirValue;
    }

    /**
     * set start value
     */
    public function setStartValue($startValue){
        $this->startValue = $startValue;
    }

    /**
     * set dir value
     */
    public function setLengthValue($lengthValue){
        $this->lengthValue = $lengthValue;
    }

    /**
     * get datatable query
     */

     public function getDataTableQuery(){

        $this->column_order = ['coupons.id', 'coupons.code', 'coupons.type', 'coupons.value', 'coupons.cart_value', 'coupons.expiry_date', ''];

        $query = self::toBase();

        if(!empty($this->code)){
            $query->where('coupons.code', 'like', '%'.$this->code.'%');
        }

        if(!empty($this->type)){
            $query->where('coupons.type', 'like', '%'.$this->type.'%');
        }

        if(!empty($this->value)){
            $query->where('coupons.value', 'like', '%'.$this->value.'%');
        }
        if(!empty($this->cart_value)){
            $query->where('coupons.cart_value', 'like', '%'.$this->cart_value.'%');
        }

        if(!empty($this->expiry_date)){
            $query->where('coupons.expiry_date', 'like', '%'.$this->expiry_date.'%');
        }

        /**
         * set order and dir value
         */
        if(isset($this->orderValue) && isset($this->dirValue)){
            $query->orderBy($this->orderValue[$this->orderValue], $this->dirValue);
        }else if(isset($this->order)){
            $query->orderBy(key($this->order), $this->order[key($this->order)]);
        }

        return $query;
     }

     /**
      * get datatable list
      */
      public function getList(){
          $query = $this->getDataTableQuery();

          if($this->lengthValue != -1){
              $query->offset($this->startValue)->limit($this->lengthValue);
          }

          return $query->get();
      }

      /**
       * count filtered data
       */
      public function count_filtered(){
          $query = $this->getDataTableQuery();
          return $query->get()->count();
      }

      /**
       * count all data
       */
      public function count_all(){
          return self::toBase()->get()->count();
      }

      /**
       * make coupon code to uppercase
       */
      public function setCodeAttribute($value){
          $this->attributes['code'] = strtoupper($value);
      }
}
