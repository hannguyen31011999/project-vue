<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table = 'bds_variant';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'facade',
        'access_road',
        'direction',
        'num_floor',
        'num_bedroom',
        'furniture',
        'juridical',
        'created_at',
        'updated_at'
    ];

    public function Products()
    {
        return $this->belongsTo('App\Model\Product','product_id','id');
    }
}
