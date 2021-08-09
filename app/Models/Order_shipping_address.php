<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_shipping_address extends Model
{
    public $timestamps = true;
    protected $table = 'order_shipping_address';
    protected $fillable = ['order_id', 'first_name', 'last_name', 'email', 'address', 'phone_number', 'postal_code', 'district', 'province', 'city', 'notes'];
    protected $attributes = [
        'notes' => null,
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
