<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type',
        'position_unique',
        'region_id',
        'customer_type_id',
        'phone',
        'sub_customer_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendLoginLink()
    {
        $plaintext = Str::random(32);
        $time = now()->addMinutes(1440);

        $this->loginTokens()->create([
            'token' => hash('sha256', $plaintext),
            'expires_at' => $time,
        ]);

        Http::post('http://10.10.30.14:8888/wa/sales-order/login', [
            'phone' => $this->phone,
            'link' => URL::temporarySignedRoute('verify-login', $time, ['token' => $plaintext])
        ]);
    }

    public function loginTokens()
    {
        return $this->hasMany(LoginToken::class);
    }

    public function positions()
    {
        return $this->belongsTo(position::class,'position_unique','unique');
    }

    public function regions()
    {
        return $this->belongsTo(region::class,'region_id','id');
    }

    public function customers()
    {
        return $this->belongsTo(customerGroup::class,'id','user_id');
    }

    public function subCustomers()
    {
        return $this->belongsTo(customerGroup::class,'id','user_id');
    }
}
