<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice_history extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'invoice_history';
    protected $fillable = ['invoice_id', 'old_data', 'new_data'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }
}
