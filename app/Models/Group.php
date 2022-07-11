<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'uuid',
        'province_id',
        'is_active',
        'group_type',
        'name',
        'code',
        'owner',
        'contact',
        'address',
        'guarantor'
    ];
}
