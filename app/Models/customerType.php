<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerType extends Model
{
    use HasFactory;

    protected $table = 'customer_types';

    protected $fillable = [
        'name',
    ];
}
