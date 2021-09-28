<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice_billing_detail extends Model
{
    public $timestamps = true;
    protected $table = 'invoice_billing_detail';
    protected $fillable = ['invoice_id', 'billing_status', 'message', 'payload'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }

}
