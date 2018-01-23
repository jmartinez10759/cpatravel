<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Log;

class Project extends Model
{

    protected $fillable = [
        'name',
        'description',
        'active',
        'business_id',
        'user_id'
    ];



    function getNameAttribute($value){
        return $value;
    }

    function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
