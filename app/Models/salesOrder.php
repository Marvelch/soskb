<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesOrder extends Model
{
    use HasFactory;

    protected $table = 'sales_orders';

    protected $fillable = [
        'id_transaction',
        'created_by',
        'so_date',
        'customer_id',
        'information',
        'customers',
        'status',
        'send_date',
        'changed_by',
        'note'
    ];

    public function customers()
    {
        return $this->belongsto(customer::class,'customer_id','id');
    }

    public function users()
    {
        return $this->belongsto(User::class,'created_by','id');
    }
}
