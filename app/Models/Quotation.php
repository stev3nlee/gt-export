<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'quotation';
    protected $fillable = ['member_id', 'quotation_number', 'product_id', 'first_name', 'last_name', 'email', 'phone', 'ip_address', 'status'];
    protected $attributes = [
        'status' => 1,
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
