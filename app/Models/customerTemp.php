<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerTemp extends Model
{
    use HasFactory;

    protected $table = 'customer_temps';

    protected $fillable = [
        'customer_id',
        'user_id'
    ];
}
