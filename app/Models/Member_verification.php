<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Member_verification extends Model
{
    public $timestamps = true;
    protected $table = 'member_verification';
    protected $fillable = ['code', 'member_id', 'status'];
    protected $attributes = [
        'status' => 1,
    ];

}
