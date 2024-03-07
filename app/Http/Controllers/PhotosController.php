<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Album;
use App\Models\Photo;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $photos = Photo::paginate(3);
        $photos = Photo::all();
        return view('photos.list',['photos'=>$photos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $albums = Album::all();
        return view('photos.create',['albums'=>$albums]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required|min:4',  
        ],
        [
            'name.min' => 'name is short',
        ]);

        $name      = $request['name'];
        $album     = $request['album_id'];
        $image     = $request['image'];
        $image     = $request->file('image')->getClientOriginalName();

        $photo = Photo::create([
            'name' => $name,
            'image' => $image,
            'album_id'=>  $album
        ]);

       $request->image->move(public_path('upload/album_covers'),$image);

        return to_route('photos.index')->with('success','Photo is created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
        return view('photos.show_photo',['photo'=>$photo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
        $albums = Album::all();
        return view('photos.edit',compact('albums','photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //

        request()->validate([
            'name' => 'required|min:4',  
        ],
        [
            'name.min' => 'name is short',
        ]);

            $name  = $request['name'];
            $album = $request['album_id'];
            $old_img = $photo->image;

            if($request->missing('image') or $request['image']==null) {
                $request['image']=$old_img;
                $imageName = $request['image'];
            }
            else{
                $image  = $request['image'];
                $image  = $request->file('image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('upload/album_covers'),$imageName);
            }

            $Data = [
                'name'  => $name,
                'image' => $imageName,  
                'album_id' => $album,  
            ];
     

        $photo->update($Data);

        return to_route('photos.index')->with('success','Photo is updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
        $photo->delete();
        return to_route('photos.index')->with('success','Photo is deleted');
    }
}
