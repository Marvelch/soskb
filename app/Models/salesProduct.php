<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesProduct extends Model
{
    use HasFactory;

    protected $table = 'sales_products';

    protected $fillable = [
        'product_id',
        'sales_id'
    ];

    public function sales()
    {
        return $this->belongsTo(sales::class,'sales_id','id');
    }
}
