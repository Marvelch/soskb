<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesCustomer extends Model
{
    use HasFactory;

    protected $table = 'sales_customers';

    protected $fillable = [
        'customer_id',
        'sales_id'
    ];

    public function sales()
    {
        return $this->belongsTo(User::class,'sales_id','id');
    }
}
