<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatContent extends Model
{
    protected $table = 'ChatContents';
    protected $primaryKey = ['ccid'];
    public $timestamps = false;
    protected $fillable = ['chatID', 'contents', 'timestamp'];
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