<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping_address extends Model
{
    public $timestamps = true;
    protected $table = 'shipping_address';
    protected $fillable = ['first_name','last_name','email','address','phone_number','zip_code','notes','status','member_id','province','city','company','type','country'];
    protected $attributes = [
        'notes' => null,
    ];

}
