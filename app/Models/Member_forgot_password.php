<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member_forgot_password extends Model
{
    public $timestamps = true;
    protected $table = 'member_forgot_password';
    protected $fillable = ['code', 'member_id', 'email', 'status'];
    protected $attributes = [
        'status' => 1,
    ];

}
