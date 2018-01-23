<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationProject extends Model
{
    protected $fillable =[
            'id',
            'user_id',
            'project_id',
            'sub_project_id',
            'travel_id',
            'active'
    ];
}
