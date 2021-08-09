<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class About extends Model
{   
	use HasSlug;
    public $timestamps = true;
    protected $table = 'about';
    protected $fillable = ['content', 'image', 'title', 'sort', 'slug', 'status'];
    protected $attributes = [
        'status' => 1,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
            //->doNotGenerateSlugsOnUpdate();
    }
}
