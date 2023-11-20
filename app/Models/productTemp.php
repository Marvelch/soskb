<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productTemp extends Model
{
    use HasFactory;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'product_temps';

    protected $fillable = [
        'product_id',
        'qty',
        'user_id'
    ];

    public function products()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
}
