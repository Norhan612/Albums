@extends('layouts.app')

@section('content')

<br>
<div class="container">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
    @endif
  </div>
<div>
<a href="{{route('photos.create')}}" class="btn btn-success">Create New Photo</a>
</div>
  <br>

    <h3 class="text-center" style="font-weight:bold; color:rgb(216, 31, 31);"> Photos </h3>
 
    <div class="products">
      <div class="row text-center">

        @foreach ($photos as $photo)

        <div class="col-md-4  my-3">

          <a href="/photos/{{$photo['id']}}">
            <!--<img class="img-fluid rounded" src="upload/album_covers/{{$photo['img']}}"  width="60%">-->
            <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$photo->image)}}"  width="60%">
          </a>

          <br><br>

          <h4 class="fw-bold">{{$photo->name}}</h4>

          @if($photo->album)
            <h3 class="fw-bold py-3 text-danger"> Album :<a href="{{route('albums.show', $photo->album->id)}}"> {{$photo->album->name}}  </a>  </h3>
            @else
                <h3> Album :  </h3>
            @endif
          
          <br>
          <div class="container d-flex ms-5">
            
                <form action="{{ route('photos.destroy',$photo->id)}}" method="post" onSubmit="return confirm('Are You Sure To Delete This Photo?')">
                    @csrf
                    @method("DELETE")
                  <button class="button btn btn-danger">Delete</button>     
                </form>
            
            <a class="button btn btn-warning ms-2" href="{{route('photos.edit',$photo->id)}}">Edit</a>
          </div>

        </div>

        @endforeach  

       
        
      </div>

     

    </div>
   
@stop


