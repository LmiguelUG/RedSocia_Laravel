<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*  RegisterController, Este controlador maneja el registro de nuevos usuarios
        así como su validación y creación. Por defecto, este controlador usa un
        rasgo para proporcionar esta funcionalidad sin necesidad de ningún código
        adicional.

        Este controlador maneja el registro de nuevos usuarios así como su
        validación y creación. Por defecto, este controlador usa un rasgo para
        proporcionar esta funcionalidad sin necesidad de ningún código adicional.

    */

    use RegistersUsers;
    protected $redirectTo = '/';

    /*   Cree una nueva instancia de controlador   */
    public function __construct()  {
        $this->middleware('guest');
    }

    /*  Obtiene un validador para una solicitud de registro entrante  */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /*  Cree una nueva instancia de usuario después de un registro válido   */
    protected function create(array $data)  {
        return User::create([
            'role' => 'user',
            'name' => $data['name'],
            'surname' => $data['surname'],
            'nick' => $data['nick'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


}
