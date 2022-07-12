<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function checkPlayerIfLogged($userId, $groupCode)
    {
        $currentDate = date('Y-m-d', time());
        return DB::table($this->table)
                    ->whereDate('created_at', $currentDate)
                    ->where('user_id', $userId)
                    ->where('group_code', $groupCode)
                    ->first();
        // return $log ? 1 : 0;
    }
}
