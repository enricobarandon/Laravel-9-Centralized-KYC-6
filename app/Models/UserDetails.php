<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'country',
        'present_address',
        'permanent_address',
        'province',
        'occupation',
        'source_of_income',
        'facebook',
        'valid_id_type',
        'id_picture',
        'selfie_with_id',

    ];
}
