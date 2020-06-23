<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name', 'surname'
    ];

    public $timestamps = false;

    public function phones()
    {
        return $this->hasMany('App\Models\Phone');
    }
}
