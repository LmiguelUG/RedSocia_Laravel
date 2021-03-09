@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2>Mis Me Gusta</h2>
            <hr>

              <div class="card-body">
                  @foreach($likes as $like)
                    @include('includes.image',['image' => $like->image])
                  @endforeach

                  <!--*********************************************** EMPLEADO PARA PAGINAR MIS WEB ********************************************-->
                  <div class="clearfix"></div>
                  {{ $likes->links() }}
              </div>
        </div>

    </div>
</div>
@endsection
