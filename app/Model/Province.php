<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'bds_province';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'province_name',
        'created_at',
        'deleted_at'
    ];

    public function Districts()
    {
        return $this->hasMany('App\Model\District','province_id','id');
    }

    public function Wards()
    {
        return $this->hasMany('App\Model\Ward','province_id','id');
    }
}
