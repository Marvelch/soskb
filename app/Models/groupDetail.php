<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupDetail extends Model
{
    use HasFactory;

    protected $table = 'group_details';

    protected $fillable = [
        'unique',
        'sales_id'
    ];
}
