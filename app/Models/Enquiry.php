<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{    
    public $timestamps = true;
    protected $table = 'enquiry';
    protected $fillable = ['company_name', 'name', 'email', 'phone', 'message', 'subject'];
}
