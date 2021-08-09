<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_shipping_detail extends Model
{
    public $timestamps = true;
    protected $table = 'order_shipping_detail';
    protected $fillable = ['order_id', 'shipping_status', 'message', 'payload'];
    protected $attributes = [
        'payload' => null,
    ];
    /*
        shipping_status
        - checkout // initial status. after checkout
        - loading_goods // on sorting center or after product is picked up
        - delivering // on courier hand
        - delivered // courier had delivered to customer
        - confirmed // confirmed by customer *not yet implemented
        - returned // order was returned
        - failed
        - other // other un-handled status
    */

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

}
