<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'Users';
    protected $primaryKey = ['userID'];
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['userID', 'password', 'email',
        'nickname', 'firstname', 'lastname', 'gender', 'DOB',
        'whatsup', 'avatar', 'created_at', 'updated_at'];
    protected $guarded = ['is_active', 'is_admin'];
    protected $hidden = ['password'];
    protected $casts = ['options' => 'json'/*, 'status' => 'bool'*/];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

//    protected function getDateFormat()
//    {
//        return time();
//    }
//
//    protected function asDateTime($value)
//    {
//        return $value;
//    }
}