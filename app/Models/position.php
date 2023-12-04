<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    use HasFactory;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'positions';

    protected $fillable = [
        'unique',
        'level',
        'title'
    ];
}
