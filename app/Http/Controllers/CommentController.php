<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Image;

class CommentController extends Controller
{

  /************************* SI NO SE HA INICIADO UNA SESSION NO SE PUEDE DIRIGIR A ESTA PAGINA  **************************/
    public function __construct() {
      $this->middleware('auth');
    }

    public function save (Request $request) {


        /************************************* VALIDACIÓN DE LOS DATOS RECIBIDOS *******************************************/
        $valodate = $this->validate( $request, [
          'image_id' => 'integer|required',
          'content'  => 'string|required'
        ]);

        /************************************** RECOLECCION LOS DATOS RECIBIDOS ********************************************/
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content  = $request->input('content');

        /*************************************** ASIGNACIÓN AL OBJETO A GUARDAR ********************************************/
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        /*************************************** GUARDAR EN BASE DE DATOS A EL OBJETO **************************************/
        $comment->save();

        /*************************************** HAGO UNA REDIRECCION ******************************************************/
        return redirect()->route('image.detail', [ 'id' => $image_id ])
        /************************** WITH ME CREARÁ UNA SESSION, UTIL PARA VALIDACION DEL UPLOAD ***************************/
                         ->with(['message'=>'Comentario hecho con Exitoso']);
    }

    public function delete($id) {
      /*************************************** CONSEGUIR DATOS DEL USUARIO LOGUEADO ****************************************/
      $user = \Auth::user();

      /*************************************** CONSEGUIR OBJETO DEL COMENTARIO *********************************************/
      $comment = Comment::find($id);

      /*************************** COMPROBAR SI USER ES EL DUEÑO DEL COMENTARIO O PUBLICACIÓN ******************************/
      if( $user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
        $comment->delete();

        return redirect()->route('image.detail', [ 'id' => $comment->image_id ])
        /************************** WITH ME CREARÁ UNA SESSION, UTIL PARA VALIDACION DEL UPLOAD ***************************/
                         ->with(['message'=>'Comentario Eliminado Correctamente']);
      } else {

        return redirect()->route('image.detail', [ 'id' => $comment->image_id ])
        /************************** WITH ME CREARÁ UNA SESSION, UTIL PARA VALIDACION DEL UPLOAD ***************************/
                         ->with(['message'=>'Comentario Eliminado Correctamente']);
      }



    }
}
