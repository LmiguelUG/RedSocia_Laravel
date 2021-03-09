<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use \App\Comment;

class HomeController extends Controller {

    public function __construct()  {
        $this->middleware('auth');
    }

    public function index()  {

/************* CONSULTA A LA BASE DE DATOS PARA OBTENER TODAS LAS IMAGENES ************************************************/

/************* USO EL PAGINATE PARA INDICAR LA CANTIDAD DE ELEMENTOS DEVUELTOS QUE DESO VER POR PAGINA (PAGINAR) *********/
      $images = Image::orderBy('id', 'desc')->paginate(2);


/************* SI NO DESEO PAGINAR MI WEB HARIA LA CONSULTA DE LA SIGUIENTE MANERA ***************************************/
/************* $images = Image::orderBy('id', 'desc')->get(); ************************************************************/
      return view('home',[ 'images' => $images ]);
    }


}
