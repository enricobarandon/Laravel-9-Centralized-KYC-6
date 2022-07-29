<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlackList;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = ['type','black_list_id','description'];

    public function black_list()
    {
        return $this->belongsTo(BlackList::class); 
    }

    public function same_user()
    {
        return $this->belongsTo(User::class,'black_list_id','id'); 
    }
}
