<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Log;

class SubProject extends Model
{
    protected $fillable =[
        'name',
        'description',
        'project_id',
        'active',
        'business_id',
        'user_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d');
    }


}
