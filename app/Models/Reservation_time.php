<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation_time extends Model
{    
    public $timestamps = true;
    protected $table = 'reservation_time';
    protected $fillable = ['hours'];
}
