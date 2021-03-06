<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use RecentlyViewed\Models\Contracts\Viewable;
use RecentlyViewed\Models\Traits\CanBeViewed;

class Product extends Model implements Viewable
{
    use HasSlug;
    use SoftDeletes;
    use CanBeViewed;
    public $timestamps = true;
    protected $table = 'product';
    protected $fillable = ['name','slug','image','price','description','status','image','reserve','description','stock','youtube'];
    protected $attributes = [
        'status' => 1,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['chassis_no', 'stock'])
            ->saveSlugsTo('slug');
            //->doNotGenerateSlugsOnUpdate();
    }

    public function brand()
    {
        return $this->belongsToMany('App\Models\Brand', 'product_brand', 'product_id', 'brand_id');
    }

    public function model()
    {
        return $this->belongsToMany('App\Models\Models', 'product_model', 'product_id', 'model_id');
    }

    public function transmission()
    {
        return $this->belongsToMany('App\Models\Transmission', 'product_transmission', 'product_id', 'transmission_id');
    }

    public function product_image()
    {
        return $this->hasMany('App\Models\Product_image')->orderby('sort');
    }

    public function accessories()
    {
        return $this->belongsToMany('App\Models\Accessories', 'product_accessories', 'product_id', 'accessories_id');
    }

    public function quotations()
    {
        return $this->hasMany('App\Models\Quotation');
    }

}
