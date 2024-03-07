@extends('layouts.app')

@section('content')
<br>

<div class="container">
    <h3 class="text-center my-5" style="font-weight:bold; color:rgb(216, 31, 31);"> Edit Album  </h3>
    <form method="post" action="{{ route('albums.update',$album->id) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" value="{{ $album->name }}" id="name" name="name">
        @error('name')
                <div style="color: red; font-weight: bold"> {{$message}}</div>
            @enderror
    </div>
  
    <div class="mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" class="form-control" id="logo" name="logo" value="{{ old('logo',$album->logo) }}">
        <img class="img-fluid rounded" src="{{asset('upload/album_covers/'.$album->logo)}}"  width="50px;">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@stop