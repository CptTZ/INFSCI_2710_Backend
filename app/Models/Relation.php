<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'Relations';
    protected $primaryKey = ['follower_userID', 'followed_userID'];
    public $timestamps = false;
    protected $fillable = ['follower_userID', 'followed_userID', 'if_notify',
        'timestamp'];
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