@extends('layouts.app')

@section('content')
<br>

<div class="container">
    <h3 class="text-center my-5" style="font-weight:bold; color:rgb(216, 31, 31);"> Edit Photo  </h3>
    <form method="POST" action="{{ route('photos.update',$photo->id) }}"enctype="multipart/form-data">
        @csrf
        @method("PUT")
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" value="{{ $photo->name }}" id="name" name="name">
        @error('name')
                <div style="color: red; font-weight: bold"> {{$message}}</div>
            @enderror
    </div>
 
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
       {{-- <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$photo->image)}}"  width="30%">--}}
        <input type="file" class="form-control" id="image" name="image">
        <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$photo->image)}}"  width="50px;">
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Album</label>
        <select class="form-select" name="album_id">
            <option selected disabled value="">Select Album</option>
            @foreach($albums as $album)
            <option value="{{$album->id}}" {{old('album',$photo->album_id)==$album->id?'selected':''}}>{{$album->name}}</option>
            @endforeach
        </select>   
        

    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@stop