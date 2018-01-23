<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    protected $primaryKey = "iden";

    protected $fillable = [
            'iden',
            'request_id',
            'user_id',
    ];
}
