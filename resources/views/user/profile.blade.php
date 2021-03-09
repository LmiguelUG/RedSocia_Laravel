@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">

            <div class="profile-user">
                  <div class="col-md-4">
                      <!--********************************** VERIFICANDO QUE USUARIO POSEA FOTO DE PERFIL ***********************************-->
                        @if($user->image)
                        <div class="container-avatar">
                            <!--****************************** IMAGEN PARA EL AVATAR ********************************************************-->
                            <img  src="{{ route('user.avatar',['file_name' => $user->image]) }}" class="avatar"/>
                        </div>
                        @endif
                  </div>

                  <div class="profile-user-info">
                        <!--**************************** DATOS DEL USUARIO QUE HIZO LA PUBLICACIÓN  ******************************************-->
                        <div class="col-md-12">
                            {{ $user->name.' '.$user->surname.' |  @'.$user->nick }}
                        </div>
                  </div>

                  <div class="clearfix"></div>
                  <hr>
              </div>
                                <br>
              <div class="clearfix"></div>
              <!--********************************** MOSTRANDO TODAS MIS PUBLICACIÓNES ***********************************************-->
              @foreach ($user->images as $image)
                @include('includes.image')
              @endforeach
        </div>
    </div>
</div>

@endsection
