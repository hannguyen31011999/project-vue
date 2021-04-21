<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'bds_product_image';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'image',
        'created_at',
        'updated_at'
    ];

    public function Products()
    {
        return $this->belongsTo('App\Model\Product','product_id','id');
    }
}
