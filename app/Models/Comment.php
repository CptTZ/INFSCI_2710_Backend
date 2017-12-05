<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'Comments';
    protected $primaryKey = ['cid'];
    public $timestamps = false;
    protected $fillable = ['pid', 'userID', 'contents', 'timestamp'];
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