<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingLog extends Model
{
    use HasFactory;

    protected $table = 'tracking_logs';

    protected $fillable = [
        'user_id',
        'approved_by',
        'group_code',
        'data'
    ];
}
