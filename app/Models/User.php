<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserType;
use App\Models\UserDetails;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'password',
        'user_type_id',
        'is_active',
        'status',
        'contact',
        'group_code'
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
    ];

    public function user_type()
    {
        return $this->belongsTo(UserType::class);
    }

    public function isAdmin()
    {
        if ($this->user_type->role == 'Administrator') {
            return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->user_type->role == $role) {
            return true;
        }
        return false;
    }

    
    public function user_details()
    {
        return $this->belongsTo(UserDetails::class,'id','user_id');
    }
}
