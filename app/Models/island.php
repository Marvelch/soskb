<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class island extends Model
{
    use HasFactory;

    protected $table = 'islands';

    protected $fillable = [
        'island_name',
    ];
}
