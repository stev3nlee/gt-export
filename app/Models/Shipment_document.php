<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Shipment_document extends Model
{
	use SoftDeletes;
    public $timestamps = true;
    protected $table = 'shipment_document';
    protected $fillable = ['invoice_id','name','slug','size','file','file_path','view','download'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('file')
            ->saveSlugsTo('slug');
            //->doNotGenerateSlugsOnUpdate();
    }

    public function quotation()
    {
        return $this->belongsTo('App\Models\Quotation');
    }

}
