<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{

  /************************* SI NO SE HA INICIADO UNA SESSION NO SE PUEDE DIRIGIR A ESTA PAGINA  **************************/
  public function __construct()  {
      $this->middleware('auth');
  }

  public function like ($image_id) {

    /*************************************************** RECOGE DATOS DEL USUARIO *****************************************/
    $user = \Auth::user();
    $user_id = $user->id;

    /*************************************************** SABER SI YA EXISTE EL LIKE DEL USUARIO LOGUEADO ******************/
    $isset_like = Like::where('user_id', $user_id)->where('image_id', $image_id)->count();

    /*************************************************** RECOGE DATOS DE LA IMAGEN ****************************************/
    if($isset_like == 0) {
      $like = new Like();
      $like->user_id = $user_id;
      $like->image_id = (int)$image_id;

      /*************************************************** GUARDA EN LA BASE DE DATOS ***************************************/
      $like->save();

      return response()->json([ 'like' => $like]);
    } else {
      return response()->json([ 'message' => 'Like Ya Existe']);
    }
}

  public function dislike ($image_id) {

      /*************************************************** RECOGE DATOS DEL USUARIO *****************************************/
      $user = \Auth::user();
      $user_id = $user->id;

      /*************************************************** SABER SI YA EXISTE EL LIKE DEL USUARIO LOGUEADO ******************/
      $like = Like::where('user_id', $user_id)->where('image_id', $image_id)->first();

      if ($like) {
          /*************************************************** ELIMINAR DE LA BASE DE DATOS ***************************************/
          $like->delete();
          return response()->json([ 'dislike' => $like ]);
      } else {
          return response()->json([ 'message' => 'Error, Like no existe']);
      }
  }

  public function likes() {
    /*************************************************** RECOGE DATOS DEL USUARIO *****************************************/
    $user = \Auth::user();
    /*************************************************** OBTENER TODOS MIS LIKES ******************************************/
    $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);
     return view('like.likes', ['likes' => $likes]);
  }

}
