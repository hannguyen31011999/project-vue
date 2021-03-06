<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'bds_district';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'province_id',
        'district_name',
        'url',
        'created_at',
        'deleted_at'
    ];

    public function Provinces()
    {
        return $this->belongsTo('App\Model\Province','province_id','id');
    }

    public function Wards()
    {
        return $this->hasMany('App\Model\Ward','district_id','id');
    }
}
