<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'bds_order';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'fullname',
        'address',
        'phone',
        'email',
        'total_date',
        'price',
        'created_at',
        'updated_at'
    ];

    public function Users()
    {
        return $this->belongsTo('App\Model\User','user_id','id');
    }

    public function Products()
    {
        return $this->belongsTo('App\Model\Product','product_id','id');
    }
}
