<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Log;

class Travel extends Model
{
    protected $fillable =[
        'id',
        'name',
        'description',
        'project_id',
        'sub_project_id',
        'active',
        'business_id',
        'label',
        'user_id',
        'business_id'];

    protected $casts = [
        'business_id'   => 'string',
        'user_id'       => 'string'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function subproject()
    {
        //return $this->belongsTo('App\SubProject','sub_project_id','id');
        return $this->belongsTo('App\SubProject','sub_project_id','id');
    }

    function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d');
    }
}
