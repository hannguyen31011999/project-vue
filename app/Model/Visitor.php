<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'bds_visitor';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ip',
        'created_at',
        'updated_at'
    ];
}
