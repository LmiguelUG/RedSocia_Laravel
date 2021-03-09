@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <!--************************* ESTA SESSION MESSAGE PROVIENE DEL UPDATE DEL USUARIO AUTENTICADO ***************************-->
          @if (session('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif

            <div class="card pub-image pub-image-detail">
                <div class="card-header">
                  @if($image->user->image)
                  <div class="col-md-6 container-avatar">
                      <!--****************************************** IMAGEN PARA EL AVATAR **********************************************-->
                      <img  src="{{ route('user.avatar',['file_name' => $image->user->image]) }}" class="avatar"/>
                  </div>
                  @endif


                  <div class="pub_user_data">
                      <!--************************* DATOS DEL PROVEEDOR DE LA PUBLICACION DE LA IMAGEN **********************************-->
                      {{ $image->user->name.' '.$image->user->surname }} <span class="color-nick"> {{ ' | @'.$image->user->nick}} </samp>
                  </div>

                </div>

<!--****************************************** DONDE SE MOSTRARÁ LA IMAGEN Y SUS DETALLES  *********************************************-->
                      <div class="card-body">
                          <div class="image-detail image-container">
                            <img src=" {{ route('image.getImage', ['file_name' => $image->image_path]) }}" />
                          </div>

                          <div class="description">
                              <span class="color-nick">{{ '@'.$image->user->nick }}</span>
                              <span class="color-nick"> {{ ' | '.\FormatTime::LongTimeFilter($image->user->created_at)}} </span>
                              <p>{{ $image->description }}</p>
                          </div>

<!--************************************* IMAGEN DEL CORAZONCITO DE LIKE *************************************************************-->
                          <div class="container-likes">
                              <!--************************ SABER SI USUARIO LOGUEADO FUE QUIEN DIO EL LIKE ***************************-->
                              <?php $user_like = false; ?>
                              @foreach ($image->likes as $like)
                                  @if($like->user_id == Auth::user()->id)
                                      <?php $user_like = true; ?>
                                  @endif
                              @endforeach

                              @if($user_like)
                                  <img src="{{ asset('/img/hearts-red.png') }} " data-id="{{ $image->id }}" class="btn-dislike"/>
                                  <!--************************ MOSTRAR NUMEROS DE LIKES  *********************************************-->
                                  @if(count($image->likes) > 0)
                                       <span class="likes"> ({{ count($image->likes) }})</span>
                                  @endif
                              @else
                                  <img src="{{ asset('/img/hearts-gray.png') }} " data-id="{{ $image->id }}" class="btn-like"/>
                              @endif
                          </div>

                          @if(Auth::user() && Auth::user()->id == $image->user->id )
                          <div class="actions">
                            <a href="" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('image.delete',['id' => $image->id]) }}" class="btn btn-sm btn-danger">Delet</a>
                          </div>
                          @endif

                          <div class="clearfix"></div>
                          <div class="comments ">

                          <a class="btn btn-link btn-sm btn-comments">Comentarios ({{ \App\Comment::where('image_id',$image->id )->count() }})</a>

                          <!--******************************** FORMULARIO PARA SOLICITAR EL COMENTARIO *********************************-->
                          <form class="" action="{{route('comment.save')}}" method="post">
                              <!--************************ @csrf NOS PERMITE DAR SEGURIDAD AL FORMULARIO  ******************************-->
                              @csrf

                              <input type="hidden" name="image_id" value="{{$image->id}}" />
                              <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content" placeholder="Escribir un Comentario " required></textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                              </p>

                              <input type="submit" class="btn btn-success" value="Comentar">
                          </form>

                          <div class="panel-comments">
                              @foreach ($image->comments as $comment)
                                  <div>
                                    <span class="color-nick panel-comments">{{ '@'.$comment->user->nick }}</span>
                                    <span class="color-nick"> {{ ' | '.\FormatTime::LongTimeFilter($comment->user->created_at)}} </span>
                                    <p >{{ $comment->content }}
                                      <!--************** BOTON BORRAR SOLO APARECERÁ SI EL USER LOGUEADO ES QUIEN HIZO ******************-->
                                      <!--************** EL COMENTARIO O SI ES QUIEN PUBLICO LA IMAGEN **********************************-->

                                      @if( Auth::check() && ($comment->user_id == \Auth::user()->id || $comment->image->user_id == \Auth::user()->id))
                                      <a href="{{ route('comment.delete',['id' => $comment->id]) }}" class="btn btn-sm btn-link ">Eliminar</a>
                                      @endif
                                    </p>


                            </div>
                              @endforeach
                          </div>

                        </div>
                      </div>

          </div>
        </div>
    </div>
</div>
@endsection
