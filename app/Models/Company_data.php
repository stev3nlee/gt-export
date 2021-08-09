<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company_data extends Model
{    
    public $timestamps = true;
    protected $table = 'company_data';
    protected $fillable = ['facebook', 'instagram', 'youtube', 'email', 'line', 'whatsapp', 'address', 'hours', 'telephone', 'google_map', 'twitter'];
}
