<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodTag extends Model
{
    protected $primaryKey ="iden";
    protected $fillable = [
            'iden',
            'request_id',
            'type_nationality',
            'number_foods',
            'daily_budget',
            'total_budget',
            'naci_checks',
            'naci_debit',
            'naci_credit',
            'naci_cash',
            'naci_amex',
            'extra_checks',
            'extra_debit',
            'extra_credi',
            'extra_cash',
            'extra_amex'];
    protected $casts = [
        'iden' => 'string',
    ];
}
