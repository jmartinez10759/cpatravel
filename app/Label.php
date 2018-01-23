<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table='labels';

    protected $primaryKey = 'iden';

    protected $fillable = [
                'id',
                'iden',
                'name',
                'description',
                'national_maximum_deductible_amount',
                'foreign_maximum_deductible_amount',
                'national_company_policies',
                'foreign_company_policies',
                'active',
                'user_id',
                'business_id',
                'project_id',
                'sub_project_id',
                'travel_id',
                'type_label'
    ];


    protected $casts = [
        'iden' => 'string',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function subproject()
    {
        return $this->belongsTo('App\SubProject','sub_project_id','id');
    }

    public function travel()
    {
        return $this->belongsTo('App\Travel','travel_id','id');
    }
}
