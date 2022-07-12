<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use App\Models\TrackingLog;
use App\Models\Group;

class GroupStatistics extends Model
{
    use HasFactory;

    protected $table = 'groups_statistics';

    protected $fillable = [
        'group_code',
        'total_player_registered',
        'total_player_logged_in'
    ];

    public function incrementGroupStat($userId, $groupCode)
    {
        $statId = $this->checkGroupStatsToday($groupCode);

        if (!$statId) {
            // create group stat for today

            $totalPlayerRegistered = $this->getGroupTotalPlayerRegistered($groupCode);
            return DB::table($this->table)
                    ->insert([
                        'group_code' => $groupCode,
                        'total_player_registered' => $totalPlayerRegistered,
                        'total_player_logged_in' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
        } else {
            // group stat exists today
            // increment values
            // check tracking logs to prevent duplicate login count
            $trackingModel = new TrackingLog();
            $checkIfLogged = $trackingModel->checkPlayerIfLogged($userId, $groupCode);
            // dd($checkIfLogged);
            // dd(!$checkIfLogged);
            if ($checkIfLogged === null) {
                $incrementGroupStat = DB::table($this->table)
                                        ->where('id', $statId->id)
                                        ->update([
                                            'total_player_logged_in' => DB::raw('total_player_logged_in + 1')
                                        ]);
            }
        }
    }

    public function checkGroupStatsToday($groupCode)
    {
        $currentDate = $this->getCurrentDate();
        return DB::table($this->table)
                    ->select('id')
                    ->where('group_code', $groupCode)
                    ->whereDate('created_at', $currentDate)
                    ->first();
    }

    public function getCurrentDate()
    {
        return date('Y-m-d', time());
    }

    public function getGroupTotalPlayerRegistered($groupCode)
    {
        return DB::table('users')
                ->where('group_code', $groupCode)
                ->where('user_type_id', 5)
                ->count();
    }

    public function group()
    {
        return $this->belongsTo(Group::class,'group_code','code'); 
    }
}
