<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller {

/************************* SI NO SE HA INICIADO UNA SESSION NO SE PUEDE DIRIGIR A ESTA PAGINA  **************************/
  public function __construct() {
    $this->middleware('auth');
  }

  public function upload() {
      return view ('image.upload');
  }

  public function save(Request $request) {


/********************************************** RECOGER DATOS  *********************************************************/
  $image_path  = $request->file('image_path');
  $description = $request->input('description');

  /*************************************** VALIDACIÓN DE LOS DATOS RECIBIDOS *********************************************/
      $valodate = $this->validate( $request, [
        'description' => 'required',
        'image_path'  => 'required|image'

      ]);


/**************************************** ES NECESARIO EL ID DEL USUSARIO ACTIVO ***************************************/
  $user = \Auth::user();
  $user_id = $user->id;

/*********************************************** ASIGNAR VALORES *******************************************************/
    $image = new Image();
    $image->description = $description;
    $image->user_id = $user_id;

    if($image_path) {
      $image_path_name = time().$image_path->getClientOriginalName();
       Storage::disk('images')->put($image_path_name, File::get($image_path));
       Storage::disk('users')->put($image_path_name, File::get($image_path));
       $image->image_path = $image_path_name;
    }

/***************************************** GUARDAR EN LA BASE DE DATOS *************************************************/
    $image->save();

    return redirect()->route('home')
/****************** WITH ME CREARÁ UNA SESSION, UTIL PARA VALIDACION DEL UPLOAD ****************************************/
                     ->with(['message'=>'CARGA DE IMAGEN FINALIZADA CORRECTAMENTE']);
  }



/*********************************************** OBTENER IMAGEN ********************************************************/
    public function getImage ($file_name) {
      $image = Storage::disk('images')->get($file_name);
      return new response($image, 200);
    }



/****************************************** DETALLES DE LAIMAGEN PUBLICADA *********************************************/
    public function detail ($id) {
      $image = Image::find($id);

      return view('image.detail',['image' => $image]);
    }

/****************************************** ELIMINACIÓN DE UNA PUBLICACIÓN *********************************************/
    public function delete($id) {
        $image = Image::find($id);
        $user  = \Auth::user();

        /********************* DEBIDO A LA RELACION DE LOS comments Y likes CON images DEBO ELIMINAR PRIMERO ESTOS *******/
        $comments = Comment::where('image_id', $id)->get();
        $likes    = Like::where('image_id',$id)->get();

        if($user && $image && $image->user->id == $user->id) {
            /************ ELIMINAR LOS COMENTS Y LOS LIKES DE LA IMAGEN *************************************************/
            if ( $comments && count($comments) >= 1 ) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            if ( $likes && count($likes) >= 1 ) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            /************ ELIMINAR LOS FICHEROS DE "STORAGE" *************************************************************/
            Storage::disk('images')->delete($image->image_path);

            /************ ELIMINAR LA IMAGEN  ****************************************************************************/
            $image->delete();
            $message =  array('message' =>  'Exito al Eliminar la Imagen');
        } else {
          $message =  array('message' =>  'Error al Eliminar la Imagen');
        }

        return redirect()->route('home')->with($message);
    }
}
