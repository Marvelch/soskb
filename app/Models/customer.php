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
        'customer_type_name',
        'province',
        'created_by',
        'status',
        'changed_by'
    ];
}
