<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comments';

  //  RELATION MANY TO ONE
  public function image() {
    return $this->belongsTo('App\Image', 'image_id');
  }

  //  RELATION MANY TO ONE
  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }
}
