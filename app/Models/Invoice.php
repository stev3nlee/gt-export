<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'invoice';
    protected $fillable = ['member_id', 'quotation_id', 'invoice_number', 'sub_total', 'shipping_cost', 'date', 'payment_terms', 'type', 'port_of_destination', 'consignee_address', 'contact_no', 'email', 'total', 'status'];
    protected $attributes = [
        'status' => 'draft',
    ];

    public function invoice_details()
    {
        return $this->hasMany('App\Models\Invoice_detail');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function quotation()
    {
        return $this->belongsTo('App\Models\Quotation');
    }

}
