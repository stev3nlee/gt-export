<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product_image extends Model
{
	use SoftDeletes;
    public $timestamps = true;
    protected $table = 'product_image';
    protected $fillable = ['product_id','image'];

}
