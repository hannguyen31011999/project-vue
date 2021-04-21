<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $table = 'bds_slug';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'categories_id',
        'product_id',
        'url',
        'created_at',
        'deleted_at'
    ];
}
