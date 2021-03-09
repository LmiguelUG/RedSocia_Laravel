<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $table = 'likes';

  //  RELATION MANY TO ONE
  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }

  //  RELATION MANY TO ONE
  public function image() {
    return $this->belongsTo('App\Image', 'image_id');
  }
}
