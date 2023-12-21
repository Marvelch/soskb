<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerGroup extends Model
{
    use HasFactory;

    protected $table = 'customer_groups';

    protected $fillable = [
        'customer_type_id',
        'sub_customer_type_id',
        'user_id'
    ];

    public function customergroup()
    {
        return $this->belongsTo(customerType::class,'customer_type_id','id');
    }

    public function subCustomergroup()
    {
        return $this->belongsTo(subCustomerType::class,'sub_customer_type_id','id');
    }
}
