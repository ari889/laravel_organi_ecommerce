<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'short_description', 'description', 'regular_price', 'sale_price', 'sku', 'stock_status', 'quantity', 'image', 'images', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    private $order = array('products.id' => 'desc');
    private $column_order;

    private $name;
    private $sku;
    private $category;

    public function setName($name){
        $this->name = $name;
    }

    public function setSku($sku){
        $this->sku = $sku;
    }


    public function setCategory($category){
        $this->category = $category;
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
     * get all product data
     */
    public function get_datatable_query(){

        $this->column_order = ['products.id', 'products.name', '', 'products.sku', 'products.regular_price', 'products.sale_price', 'products.category_id', ''];

        $query = self::with('category:id,name');

        if(!empty($this->name)){
            $query->where('products.name', 'like', '%'.$this->name.'%');
        }

        if(!empty($this->sku)){
            $query->where('products.sku', 'like', '%'.$this->sku.'%');
        }

        if(!empty($this->category)){
            $query->where('products.category_id', $this->category);
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

    public function count_filtered(){
        $query = $this->get_datatable_query();
        return $query->get()->count();
    }

    public function count_all(){
        return self::toBase()->get()->count();
    }

    public function setSkuAttribute($value){
        return $this->attributes['sku'] = 'DIGI_'.$value;
    }

    /**
     * one to many relationship with order items
     */
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

}
