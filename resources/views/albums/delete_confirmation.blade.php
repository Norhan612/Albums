@extends('layouts.app')

@section('content')
<br>
<div class="card bg-white mx-3 mx-md-4 mt-n6">
    <div class="container align-items-center">
        <h3 class="text-center my-5" style="font-weight:bold; color:rgb(216, 31, 31);"> Delete Confirmation </h3>
        <form method="GET" action="{{ route('albums.delete-confirm', $album->id) }}">
        <!-- @csrf
        @method('DELETE') -->
        <p class="lead text-dark fs-3 mt-3">Are you sure you want to delete the album "{{ $album->name }}"?</p>
        
        @if ($album->photos()->exists())
            <p class="lead text-dark mt-3">This album contains {{ $album->photos()->count() }} photos.</p>
            <p class="lead text-dark mt-3">Please choose one of the following options:</p>
            <input type="submit" name="delete_photos" class="btn btn-danger" value="Delete all photos">
            <div class="my-3">
            <input type="submit" name="move_photos" class="btn btn-success" value="Move photos to another album">

            @if ($errors->has('album_id'))
                <p>{{ $errors->first('album_id') }}</p>
            @endif
            
            <label class="lead text-dark mt-3 ms-3" for="album_id">Album ID:</label>
            <input type="text" name="album_id" id="album_id">
            </div>
        @endif
    </form>
    </div>
</div>    

@stop