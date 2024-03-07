@extends('layouts.app')

@section('content')

<br>
<div class="container">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
    @endif
  </div>

  <br>

    <h3 class="text-center" style="font-weight:bold; color:rgb(216, 31, 31);"> {{$album->name}} </h3>
<br> <br>
    
    <div class="container">
      <div class="row text-center">

    
        <div class="col-md-6">
          
            <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$album->logo)}}"  width="60%">

        </div>
        <div class="col-md-6">
        <h3 class="text-center my-3" style="font-weight:bold; color:rgb(216, 31, 31);"> Photos</h3>
        @if($album->photos)
        <div class="row">
        @foreach ($album->photos as $photo)
        <div class="col-md-4">

          <a href="{{route('photos.show',$photo->id)}}">
            <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$photo->image)}}"  width="60%">
          </a>

          <br><br>

          <h4 class="fw-bold">{{$photo->name}}</h4>
          <br>

        </div>

        @endforeach  
      </div>
         
          <br>
          @else
                <h3> Photos :  </h3>
            @endif
            <!-- <div>
              <a href="{{route('photos.create')}}" class="btn btn-success">Create New Photo</a>
            </div> -->
        </div>

        
      </div>

  

    </div>
@stop


