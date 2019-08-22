<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
class Property extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
