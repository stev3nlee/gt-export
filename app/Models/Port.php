<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Port extends Model
{
    public $timestamps = true;
    protected $table = 'port';
    protected $fillable = ['shipping_cost','country_id','port'];
    protected $attributes = [
        'status' => 1,
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Shipping_cost');
    }
}	
