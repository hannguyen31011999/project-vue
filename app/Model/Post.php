<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'bds_post';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'image',
        'url',
        'created_at',
        'updated_at'
    ];

    public function Users()
    {
        return $this->belongsTo('App\Model\User','user_id','id');
    }

    public function getInfoCreate()
    {
        return $this->belongsTo('App\Model\User','user_id','id')->get(['fullname','created_at']);
    }
}
