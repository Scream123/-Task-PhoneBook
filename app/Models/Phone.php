<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
      'number', 'post_id'
    ];
    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

}
