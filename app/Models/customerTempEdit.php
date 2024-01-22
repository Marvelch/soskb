<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerTempEdit extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'customer_temp_edits';

    protected $fillable = [
        'id_transaction',
        'customer_id',
        'user_id'
    ];

    public function customers()
    {
        return $this->belongsTo(customer::class,'customer_id','id');
    }
}
