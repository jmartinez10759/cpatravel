<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAccount extends Model
{
    public $fillable =[
            'id',
            'name',
            'active'
    ];
}
