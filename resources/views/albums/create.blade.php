@extends('layouts.app')

@section('content')
<br>

<div class="container">
    <h3 class="text-center my-5" style="font-weight:bold; color:rgb(216, 31, 31);"> Create Album  </h3>
    <form method="POST" action="{{ route('albums.store') }}"enctype="multipart/form-data">
        @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        @error('name')
                <div style="color: red; font-weight: bold"> {{$message}}</div>
            @enderror
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" class="form-control" id="logo" name="logo" value="{{old('logo')}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@stop