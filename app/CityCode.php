<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityCode extends Model
{
    protected $fillable =[
            'code_iata',
            'name',
            'serves',
            'state',
            'country'];
}
