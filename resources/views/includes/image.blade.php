<div class="card pub-image">
    <div class="card-header">
      @if($image->user->image)
      <div class="col-md-6 container-avatar">
          <!--*********************** IMAGEN PARA EL AVATAR ****************************************************************-->
          <img  src="{{ route('user.avatar',['file_name' => $image->user->image]) }}" class="avatar"/>
      </div>
      @endif

      <!--**************************** DATOS DEL USUARIO QUE HIZO LA PUBLICACIÓN  ******************************************-->
      <div class="pub_user_data">
        <a  href="{{ route('profile', ['id' => $image->user_id ]) }}" >
          <!--****************************************** IMAGEN PARA EL AVATAR *********************************************-->
          {{ $image->user->name.' '.$image->user->surname }}
          <span class="color-nick"> {{ ' | @'.$image->user->nick}} </span>
        </a>
      </div>

    </div>

    <div class="card-body">
        <div class="image-container">
            <img src=" {{ route('image.getImage', ['file_name' => $image->image_path]) }}" />
        </div>

        <div class="description">
            <span class="color-nick">{{ '@'.$image->user->nick }}</span>
            <span class="color-nick"> {{ ' | '.\FormatTime::LongTimeFilter($image->user->created_at)}} </span>
            <p>{{ $image->description }}</p>

        </div>

<!--************************************* IMAGEN DEL CORAZONCITO DE LIKE **************************************************************-->
        <div class="container-likes">
            <!--************************ SABER SI USUARIO LOGUEADO FUE QUIEN DIO EL LIKE ************************************-->
            <?php $user_like = false; ?>
          @foreach ($image->likes as $like)
              @if($like->user_id == Auth::user()->id)
                <?php $user_like = true; ?>
              @endif
          @endforeach

          @if($user_like)
            <img src="{{ asset('/img/hearts-red.png') }} " data-id="{{ $image->id }}" class="btn-dislike"/>
            <!--************************ MOSTRAR NUMEROS DE LIKES  **********************************************************-->
            @if(count($image->likes) > 0)
               <span class="likes"> ({{ count($image->likes) }})</span>
            @endif
          @else
            <img src="{{ asset('/img/hearts-gray.png') }} " data-id="{{ $image->id }}" class="btn-like"/>
          @endif
        </div>

        <!-- PARA CONTAR TAMBIEN SE PUDO HABER EMPLEADO ESTE CODIGO:"\App\Comment::where('image_id',$image->id )->count()"-->
        <a  href="{{ route('image.detail',['id' => $image->id]) }}" class="btn btn-link btn-sm btn-comments">Comentarios ( {{ count($image->comments) }} ) </a>
    </div>
</div>
