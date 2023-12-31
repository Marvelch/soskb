<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_order_details';

    protected $fillable = [
        'id_transaction',
        'product_id',
        'qty',
        'unit_id'
    ];

    public function products()
    {
        return $this->belongsto(product::class,'product_id','id');
    }

    public function units()
    {
        return $this->belongsto(unit::class,'unit_id','id');
    }
}
