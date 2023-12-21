<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'customer_number',
        'name',
        'address',
        'customer_type_id',
        'sub_customer_type_id',
        'island_id',
        'region_id',
        'city_id',
        'created_by',
        'status',
        'changed_by'
    ];

    public function customerType()
    {
        return $this->belongsTo(customerType::class,'customer_type_id','id');
    }

    public function subCustomerType()
    {
        return $this->belongsTo(subCustomerType::class,'sub_customer_type_id','id');
    }

    public function region()
    {
        return $this->belongsTo(region::class,'region_id','id');
    }

    public function city()
    {
        return $this->belongsTo(city::class,'city_id','id');
    }
}
