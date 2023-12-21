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
}
