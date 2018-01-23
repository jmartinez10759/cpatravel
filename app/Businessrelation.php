<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Businessrelation extends Model
{
    protected  $table ='business_relation';

    protected $filable = ['user_id','business_id'];
}
