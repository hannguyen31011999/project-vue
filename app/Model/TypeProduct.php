<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $table = 'bds_product_type';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'categories_name',
        'name',
        'price',
        'created_at',
        'updated_at'
    ];

    public function Products()
    {
        return $this->hasMany('App\Model\Product','type_id','id');
    }
}
