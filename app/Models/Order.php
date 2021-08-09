<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'order';
    protected $fillable = ['member_id', 'cart_id', 'invoice_number', 'sub_total', 'shipping_fee', 'discount_price', 'discount_percentage', 'total_price', 'promo_code', 'status', 'last_shipping_status', 'last_billing_status', 'tracking_number', 'payment_method', 'tax', 'sub_total_original','day_delivery','time_delivery', 'week_ongoing', 'date_ongoing', 'shipping_stripe_id', 'subscription_update'];
    protected $attributes = [
        'status' => 1,
        'shipping_fee' => 0, // value that customer should pay
        'payment_method' => null,
        'print_status' => 0,
        'week_ongoing' => 1,
    ];

    public function order_weeks()
    {
        return $this->hasMany('App\Models\Order_week')->orderby('week');
    }

    public function order_details()
    {
        return $this->hasMany('App\Models\Order_detail');
    }

    public function order_billing_details()
    {
        return $this->hasMany('App\Models\Order_billing_detail')->orderBy('created_at', 'desc');
    }

    public function order_shipping_details()
    {
        return $this->hasMany('App\Models\Order_shipping_detail')->orderBy('created_at', 'desc');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function order_billing_address()
    {
        return $this->hasOne('App\Models\Order_billing_address');
    }

    public function order_shipping_address()
    {
        return $this->hasOne('App\Models\Order_shipping_address');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function order_gifts()
    {
        return $this->hasMany('App\Models\Order_gift');
    }

    public function order_coupon()
    {
        return $this->hasOne('App\Models\Order_coupon');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\Subscriptions');
    }

}
