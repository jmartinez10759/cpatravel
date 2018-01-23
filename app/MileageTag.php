<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MileageTag extends Model
{
    protected $primaryKey ="iden";
    protected $fillable =[
                'id',
                'iden',
                'type_nationality',
                'request_id',
                'number_days',
                'authorized_amount',
                'total_amount',
                'naci_checks',
                'naci_debit',
                'naci_credit',
                'naci_cash',
                'naci_amex',
                'extra_checks',
                'extra_debit',
                'extra_credi',
                'extra_cash',
                'extra_amex'
            ];
    protected $casts = [
        'iden' => 'string',
    ];
}
