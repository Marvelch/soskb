<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productTempEdit extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'product_temp_edits';

    protected $fillable = [
        'id_transaction',
        'product_id',
        'qty',
        'unit_id',
        'user_id'
    ];

    public function products()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }

    public function units()
    {
        return $this->belongsTo(unit::class,'unit_id','id');
    }
}
