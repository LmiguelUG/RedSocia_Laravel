@extends('layouts.app')

<!--**** USO LA SECTION 'content' PARA PODER MANTENER EL CONTENIDO EN UN PANEL ESPECIFICO POR DECIRLO DE ALGUNA MANERA ****-->
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Configuración de Mi Cuenta</div>

                <div class="card-body">
<!--******************* ES NECESARIO EL enctype="multipart/form-data" PARA MANEJAR ARCHIVO EN EL FORMULARIO **************-->
                    <form method="POST" action="{{ route('user.update') }} " enctype="multipart/form-data" aria-label="">
                        @csrf
<!--************************************************ SOLICITUD DEL NOMBRE  ***********************************************-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--************************************************ SOLICITUD DEL APELLIDO  ***********************************************-->
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ Auth::user()->surname }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--*************************************************** SOLICITUD DEL ALIAS  ***********************************************-->
                        <div class="form-group row">
                            <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" value="{{ Auth::user()->nick }}" required autofocus>

                                @if ($errors->has('nick'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nick') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<!--*************************************************** SOLICITUD DEL EMAIL  ***********************************************-->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--************************************************** SOLICITUD DEL IMAGEN  **********************************************-->
                        <div class="form-group row">
                            <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6">

                                <div class="col-md-6" class="container-avatar">
                              <!--******************************** IMAGEN PARA EL AVATAR ***********************************-->
                                @if(Auth::user()->image)
                                  <img  src="{{ route('user.avatar',['file_name' => Auth::user()->image]) }} " class="avatar"/>
                                @endif
                                </div>

                                <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path">

                                 @if ($errors->has('image_path'))
                                     <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('image_path') }}</strong>
                                     </span>
                                @endif
                            </div>
                        </div>


<!--*************************************************** BOTON DE GUARDAR *************************************************-->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
