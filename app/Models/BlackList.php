<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    use HasFactory;

    protected $table = 'black_list';

    protected $fillable = [
        'type',
        'user_id',
        'bad_first_name',
        'bad_middle_name',
        'bad_last_name',
        'bad_date_of_birth',
        'remarks'
    ];
}
