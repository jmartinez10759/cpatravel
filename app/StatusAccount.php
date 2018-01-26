<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAccount extends Model
{	
	protected $table = "status_accounts";
    public $fillable =[
            'id',
            'name',
            'active'
    ];
    
}
