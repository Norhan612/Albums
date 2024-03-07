@extends('layouts.app')

@section('content')
<br>

<div class="container">
    <h3 class="text-center my-5" style="font-weight:bold; color:rgb(216, 31, 31);"> Create Photo  </h3>

   
    <form method="POST" action="{{ route('photos.store') }}"enctype="multipart/form-data">
        @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
        @error('name')
                <div style="color: red; font-weight: bold"> {{$message}}</div>
            @enderror
    </div>
   
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

       
    <div class="mb-3">
        <label for="category" class="form-label">Albums</label>
        <select class="form-select" name="album_id">
            <option selected disabled value="">Select Album</option>
            @foreach($albums as $album)
            <option value="{{$album->id}}">{{$album->name}}</option>
            @endforeach
        </select>    

    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@stop