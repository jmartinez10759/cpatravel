<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    protected $fillable = [
        'key',
        'state_id',
        'name',
        'status'];
}
