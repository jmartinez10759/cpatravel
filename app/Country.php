<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected  $table="countrys";
    public 	$fillable = [
        'name',
        'abbreviation'];
}
