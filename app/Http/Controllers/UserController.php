<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    public function config() {
      return view ('User.config');
    }

    public function __construct() {
      $this->middleware('auth');
    }

    public function update(Request $request) {
/**************** ALMACENARÉ EL USUARIO IDENTIFICADO EN UNA VARIABLE **************************************************/
      $authenticated = \Auth::user();
      $id            = $authenticated->id;
/**************** RECIBIENDO LOS DATOS DEL FORMULARIO DE 'Configuracion de Cuenta' ************************************/
      $name    = $request->input('name');
      $surname = $request->input('surname');
      $nick    = $request->input('nick');
      $email   = $request->input('email');
/****************** VALIDANDO LOS DATOS DEL FORMULARIO DE 'Configuracion de Cuenta' ************************************/
/****************** AUTOMATICAMENTE EN LA LARAVEL HEREDO UN METODO "VALIDATION" PARA VALIDAD CON REGLAS ****************/
      $validate = $this->validate($request, [
        'name'    => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'nick'    => 'required|string|max:255|unique:users,nick,'.$id,
        'email'   => 'required|string|email|max:255|unique:users,email,'.$id
      ]);
/****************** ASIGNAR NUEVOS VALORES AL USUARIO IDENTIFICADO *****************************************************/
    $authenticated->name    = $name;
    $authenticated->surname = $surname;
    $authenticated->nick    = $nick;
    $authenticated->email   = $email;

/****************** RECOGER IMAGEN Y SUBIRLA ***************************************************************************/
    $image_path = $request->file('image_path');
    if($image_path) {
        /****************** PONER NOMBRE UNICO *************************************************************************/
        $image_path_name = time().$image_path->getClientOriginalName();

        /****************** GUARDAR EN LA CARPETA STORAGE (storage/app/users) ******************************************/
        Storage::disk('users')->put($image_path_name, File::get($image_path));

        /****************** SETEO EL NOMBRE ****************************************************************************/
        $authenticated->image = $image_path_name;
    }
/****************** REALIZARÁ LA ACTUALIZACIÓN EN LA BASE DE DATOS *****************************************************/
    $authenticated->update();

    return redirect()->route('home')
/****************** WITH ME CREARÁ UNA SESSION, UTIL PARA VALIDACION DEL UPDATE ****************************************/
                     ->with(['message'=>'ACTUALIZACION FINALIZADA CORRECTAMENTE']);
    }


    public function getImage($file_name){
      $file = Storage::disk('users')->get($file_name);
      return new Response($file, 200);
    }

    public function profile ($id) {
      $user = User::find($id);

      return view('user.profile', ['user' => $user]);
    }
}
