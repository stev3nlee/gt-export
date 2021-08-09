<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terms extends Model
{    
    public $timestamps = true;
    protected $table = 'terms';
    protected $fillable = ['terms', 'privacy_policy'];

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language', 'terms_language', 'terms_id', 'language_id')->withPivot('terms', 'privacy_policy');
    }
}
