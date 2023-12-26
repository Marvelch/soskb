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

    public function regions()
    {
        return $this->belongsTo(region::class,'region_id','id');
    }

    public function islands()
    {
        return $this->belongsTo(island::class,'island_id','id');
    }

    public function citys()
    {
        return $this->belongsTo(city::class,'city_id','id');
    }
}
