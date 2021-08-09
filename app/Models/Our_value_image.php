<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Our_value_image extends Model
{   
    public $timestamps = true;
    protected $table = 'our_value_image';
    protected $fillable = ['image'];

}
