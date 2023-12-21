<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marketingArea extends Model
{
    use HasFactory;

    protected $table = 'marketing_areas';

    protected $fillable = [
        'island_id',
        'region_id',
        'city_id',
        'user_id'
    ];
}
