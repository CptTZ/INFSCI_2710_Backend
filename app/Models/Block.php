<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blcok extends Model
{
    protected $table = 'Blocks';
    protected $primaryKey = ['userID', 'pid'];
    public $timestamps = false;
    protected $fillable = ['userID', 'pid', 'timestamp'];
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