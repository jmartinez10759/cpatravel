<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $primaryKey = "iden";
    protected $fillable = [
                        'id',
                        'iden',
                        'user_id',
                        'request_id'];
}
