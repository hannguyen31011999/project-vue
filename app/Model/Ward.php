<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'bds_ward';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'province_id',
        'district_id',
        'ward_name',
        'url',
        'created_at',
        'deleted_at'
    ];

    public function Provinces()
    {
        return $this->belongsTo('App\Model\Province','province_id','id');
    }

    public function Districts()
    {
        return $this->belongsTo('App\Model\District','district_id','id');
    }
}
