<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserType extends Model
{
    use HasFactory;
    
    protected $table = 'user_types';

    public static function getUserRole($id){
        return DB::table('user_types')
                ->select('role')
                ->where('id', $id)
                ->first();
    }
}
