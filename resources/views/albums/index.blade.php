@extends('layouts.app')

@section('content')

<br>
<div class="container">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
    @endif
  </div>
<div>
<a href="{{route('albums.create')}}" class="btn btn-success">Create New Album</a>
<a href="{{route('photos.create')}}" class="btn btn-success">Create New Photo</a>
</div>
  <br>

    <h3 class="text-center mb-3" style="font-weight:bold; color:rgb(216, 31, 31);"> Albums </h3>
 
    <div class="categories">
      <div class="row text-center">

        @foreach ($albums as $album)

        <div class="col-md-4  my-3">

          <a href="{{route('albums.show',$album->id)}}">

            <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$album->logo)}}"  width="60%">
          </a>

          <br><br>
        
            <h4 class="text-danger fw-bold">{{$album->name}}</h4>
            
            <br>
            <div class="container d-flex ms-5">
              
                  <form action="{{ route('albums.destroy',$album->id)}}" method="post" onSubmit="return confirm('Are You Sure To Delete This Album?')">
                      @csrf
                      @method("DELETE")
                    <button class="button btn btn-danger">Delete</button>     
                  </form>

                  <a class="button btn btn-warning ms-2" href="{{ route('albums.edit',$album->id) }}">Edit</a>
            </div>
       
        </div>

        @endforeach  

       
        
      </div>

     

    </div>

@stop


