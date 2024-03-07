@extends('layouts.app')

@section('content')

<br>
<div class="container">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
    @endif
  </div>

  <br>

    <h3 class="text-center my-5" style="font-weight:bold; color:rgb(216, 31, 31);"> {{$photo['name']}} </h3>

    
    <div class="container">
      <div class="row text-center">

    
        <div class="col-md-6">
          
            <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$photo->image)}}"  width="60%">

        </div>
        <div class="col-md-6">

          <h3 class="fw-bold py-3">{{$photo['name']}}</h3>
            @if($photo->album)
            <h3 class="fw-bold py-3 text-danger"> Album :<a href="{{route('albums.show', $photo->album->id)}}"> {{$photo->album->name}}  </a>  </h3>
            @else
                <h3> Album :  </h3>
            @endif
          
          <br>

        </div>

        
      </div>

  

    </div>
@stop


