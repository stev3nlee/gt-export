<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Shipping_cost extends Model
{
    public $timestamps = true;
    protected $table = 'shipping_cost';
    protected $fillable = ['shipping_cost','country'];
    protected $attributes = [
        'status' => 1,
    ];
}
