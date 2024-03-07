<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $albums = Album::paginate(3);
        $albums = Album::all();
        return view('albums.index',['albums'=>$albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('albums.create');
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

        $name  = $request['name'];
        $logo  = $request['logo'];
        $logo  = $request->file('logo');
        $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
   
       
     //   $request['logo'] = $logoName;
     //   $input = ($request->all());
        $album = Album::create([
            'name' => $name,
            'logo' => $logoName,
        ]);

        $request->logo->move(public_path('upload/album_covers'),$logoName);

        return to_route('albums.index')->with('success','Album is created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
        return view('albums.show_album',['album'=>$album]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
        //dd($album);
        return view('albums.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Album $album)
    {
        //
        request()->validate([
            'name' => 'required|min:4',  
        ],
        [
            'name.min' => 'name is short',
        ]);

        $name  = $request['name'];
        $old_logo = $album->logo;

        if($request->missing('logo') or $request['logo']==null) {
            $request['logo']=$old_logo;
            $logoName = $request['logo'];
        }
        else{
            $logo  = $request['logo'];
            $logo  = $request->file('logo');
            $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
            $request->logo->move(public_path('upload/album_covers'),$logoName);
        }
        
        
        $Data = [
            'name'  => $name,
            'logo' => $logoName,     
        ];

        $album->update($Data);

        // $request->logo->move(public_path('upload/album_covers'),$logoName);

        return to_route('albums.index')->with('success','Album is updated');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
        if ($album->photos()->exists()) {
           
            return view('albums.delete_confirmation', compact('album'));
        }
        $album->delete();
        return to_route('albums.index')->with('success','Album is deleted');
    }

    public function deleteConfirm(Album $album, Request $request)
    {
        if ($request->has('delete_photos')) {
            // Delete all pictures associated with the album
            $album->photos()->delete();
        } elseif ($request->has('move_photos')) {
            // Move pictures to another album
            $destinationAlbumId =  $request->input('album_id');
            $destinationAlbum = Album::findOrFail($destinationAlbumId);
            $album->photos()->update(['album_id' => $destinationAlbumId]);
        }

        // Delete the album
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
}
