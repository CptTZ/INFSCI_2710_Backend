<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'Chats';
    protected $primaryKey = ['chatID'];
    public $timestamps = false;
    protected $fillable = ['userID1', 'userID2'];
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = ['options' => 'json'/*, 'status' => 'bool'*/];

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }
}