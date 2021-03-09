@extends('layouts.app')

<!--**** USO LA SECTION 'content' PARA PODER MANTENER EL CONTENIDO EN UN PANEL ESPECIFICO POR DECIRLO DE ALGUNA MANERA ****-->
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <!--**************************** ESTA SESSION MESSAGE PROVIENE DE UPLOAD DE LA IMAGEN ***************************-->
          @if (session('message'))
              <div class="alert alert-success">{{ session('message') }}</div>
          @endif

            <div class="card">
                <div class="card-header">Subir Imagen</div>

                <div class="card-body">
<!--******************* ES NECESARIO EL enctype="multipart/form-data" PARA MANEJAR ARCHIVO EN EL FORMULARIO **************-->
                    <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data" aria-label="">
                        @csrf
<!--************************************************** SOLICITUD DEL IMAGEN  **********************************************-->
                        <div class="form-group row">
                            <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                            <div class="col-md-6">

                              <!--********************************** IMAGEN PARA CARGAR ************************************-->
                                <input id="image_path" type="file" class="form-control {{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path">
                                 @if ($errors->has('image_path'))
                                     <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('image_path') }}</strong>
                                     </span>
                                @endif
                            </div>
                        </div>

<!--************************************************* SOLICITUD DEL DESCRIPCION  *******************************************-->
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                              <div class="col-md-6">
                                <!--***************************** DESCRIPCION PARA LA IMAGEN *******************************-->
                                <textarea id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                              </div>
                        </div>

<!--************************************************ BOTON DE SUBIR IMAGEN *************************************************-->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Subir Imagen
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
