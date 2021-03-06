<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'bds_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'categories_name',
        'url',
        'created_at',
        'updated_at'
    ];

    public function Products()
    {
        return $this->hasMany('App\Model\Product','categories_id','id');
    }

    public function Slugs()
    {
        return $this->hasMany('App\Model\Slug','categories_id','id');
    }
}
