<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LodgingTag extends Model
{
    protected $primaryKey ='iden';
    protected $fillable = [
                        'id',
                        'request_id',
                        'iden',
                        'type_nationality',
                        'number_nights',
                        'unit_cost',
                        'number_rooms',
                        'total_cost',
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
