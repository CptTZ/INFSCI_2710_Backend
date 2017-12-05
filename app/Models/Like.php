<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'Likes';
    protected $primaryKey = ['pid','userID'];
    public $timestamps = false;
    protected $fillable = ['pid', 'userID', 'timestamp'];
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