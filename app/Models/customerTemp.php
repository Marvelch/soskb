<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerTemp extends Model
{
    use HasFactory;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'customer_temps';

    protected $fillable = [
        'customer_id',
        'user_id'
    ];

    public function customers()
    {
        return $this->belongsTo(customer::class,'customer_id','id');
    }
}
