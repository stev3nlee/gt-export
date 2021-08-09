<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_detail extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'order_detail';
    protected $fillable = ['order_id', 'order_week_id', 'product_id', 'product_description', 'product_name', 'product_price', 'product_quantity', 'product_original_price'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function product_variant()
    {
        return $this->belongsTo('App\Models\Product_variant');
    }

    public function order_shipping_address()
    {
        return $this->hasOne('App\Models\Order_shipping_address','order_id','order_id');
    }
}
