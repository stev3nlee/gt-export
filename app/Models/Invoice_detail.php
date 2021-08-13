<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice_detail extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'invoice_detail';
    protected $fillable = ['invoice_id', 'product_id', 'vehicle_number', 'make_model', 'colour', 'ord', 'engine_cap', 'mileage', 'chassis_no', 'engine_no', 'amount'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
