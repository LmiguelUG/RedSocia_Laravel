<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //  RELATION ONE TO MANY
    public function comments() {
      return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    //  RELATION ONE TO MANY
    public function likes() {
      return $this->hasMany('App\Like');
    }

    //  RELATION MANY TO ONE
    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }
}
