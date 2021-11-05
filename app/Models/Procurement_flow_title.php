<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procurement_flow_title extends Model
{
    public $timestamps = true;
    protected $table = 'procurement_flow_title';
    protected $fillable = ['title','description'];
}
