<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'bds_product';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type_id',
        'categories_id',
        'province_id',
        'district_id',
        'ward_id',
        'title',
        'area',
        'price',
        'address',
        'desc',
        'date_start',
        'date_end',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function Types()
    {
        return $this->belongsTo('App\Model\TypeProduct','type_id','id');
    }

    public function Categories()
    {
        return $this->belongsTo('App\Model\Categories','categories_id','id');
    }

    public function Provinces()
    {
        return $this->belongsTo('App\Model\Province','province_id','id');
    }

    public function Districts()
    {
        return $this->belongsTo('App\Model\District','district_id','id');
    }

    public function Wards()
    {
        return $this->belongsTo('App\Model\Ward','ward_id','id');
    }

    public function Variants()
    {
        return $this->hasMany('App\Model\Variant','product_id','id');
    }

    public function Orders()
    {
        return $this->hasMany('App\Model\Order','product_id','id');
    }

    public function ProductImages()
    {
        return $this->hasMany('App\Model\ProductImage','product_id','id');
    }

    public function Slugs()
    {
        return $this->hasMany('App\Model\Slug','product_id','id');
    }
}
