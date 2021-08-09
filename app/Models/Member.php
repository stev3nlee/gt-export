<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    protected $table = 'member'; 
    public $timestamps = true;
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'verified', 'status', 'last_login', 'last_change_password', 'newsletter', 'dob', 'gender','session_id','guest'];
    protected $attributes = [
        'status' => 1,
        'verified' => 0,
    ];

    use SoftDeletes;

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function billing_address()
    {
        return $this->hasOne('App\Models\Billing_address');
    }

    public function shipping_address()
    {
        return $this->hasOne('App\Models\Shipping_address');
    }

}
