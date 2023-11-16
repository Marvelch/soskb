<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesOrderTemp extends Model
{
    use HasFactory;

    protected $table = 'sales_order_temps';

    protected $fillable = [
        'temp_unique',
        'user_id'
    ];
}
