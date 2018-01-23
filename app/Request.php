<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;  

class Request extends Model
{
    protected $primaryKey ="iden";
    protected $fillable = [
                        'id',
                        'iden',
                        'start_date',
                        'end_date',
                        'departure_hour',
                        'hour_return',
                        'initial_destination',
                        'initial_destination_id',
                        'final_destination',
                        'final_destination_id',
                        'days',
                        'project_id',
                        'subproject_id',
                        'user_id',
                        'travel_id',
                        'status',
                        'user_id_authorize',
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
                        'extra_amex',
                        'naci_checks_auto',
                        'naci_debit_auto',
                        'naci_credit_auto',
                        'naci_cash_auto',
                        'naci_amex_auto',
                        'extra_checks_auto',
                        'extra_debit_auto',
                        'extra_credi_auto',
                        'extra_cash_auto',
                        'extra_amex_auto'];
    protected $casts = [
        'iden' => 'string',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function subproject()
    {
        return $this->belongsTo('App\SubProject','subproject_id','id');
    }

    public function travel()
    {
        return $this->belongsTo('App\Travel','travel_id','id');
    }

    function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    /*Inicio Relacion tag de hospedaje Requests*/
    public function lodgingtag()
    {
        return $this->hasOne('App\LodgingTag','request_id','iden');
    }
    /*Fin Relacion tag de hospedaje Requests*/

    /*Inicio Relacion tag de comida Requests*/
    public function foodtag()
    {
        return $this->hasOne('App\FoodTag','request_id','iden');
    }
    /*Fin Relacion tag de comida Requests*/

    /*Inicio Relacion tag de taxi Requests*/
    public function taxitag()
    {
        return $this->hasOne('App\TaxiTag','request_id','iden');
    }
    /*Fin Relacion tag de taxi Requests*/

    /*Inicio Relacion tag de renta carro Requests*/
    public function rentcartag()
    {
        return $this->hasOne('App\RentCarTag','request_id','iden');
    }
    /*Fin Relacion tag de renta carro Requests*/

    /*Inicio Relacion tag de Seminarios Requests*/
    public function seminartag()
    {
        return $this->hasOne('App\SeminarTag','request_id','iden');
    }
    /*Fin Relacion tag de Seminarios Requests*/

    /*Inicio Relacion tag de Kilometraje Requests*/
    public function mileagetag()
    {
        return $this->hasOne('App\MileageTag','request_id','iden');
    }
    /*Fin Relacion tag de Kilometraje Requests*/

    /*Inicio Relacion tag de aereo Requests*/
    public function airtag()
    {
        return $this->hasOne('App\AirTag','request_id','iden');
    }
    /*Fin Relacion tag de aereo Requests*/

    /*Inicio Relacion tag de terrestre Requests*/
    public function landtag(){
        return $this->hasOne('App\LandTag','request_id','iden');
    }
    /*Fin Relacion tag de terrestre Requests*/







}
