<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAlbumRequest;
use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums=Album::all();
        return view("album.index",["albums"=> $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("album.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeAlbumRequest $request)
    {
        
        $album= new Album();
        $album->name=$request->name;
        $album->save();
        $photos=$request->file("photos");
        foreach ($photos as $key => $image) {
            $albumImage = new AlbumPhoto();
            $imageName = $album->id .$key. '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/albums/' . $imageName; 
            $image->move('public/images/albums', $imageName); 
            $albumImage->album_id = $album->id;
            $albumImage->image = $imagePath; 
            $albumImage->save();
        }
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = Album::find($id);
        if (!$album) {
            abort(404);
        }
        return view("album.edit",["album"=> $album]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::find($id);
        if (!$album) {
            abort(404);
        }
        $album->name=$request->name;
        $photos=$request->file("photos");
        if($photos){
        foreach ($album->photos as $photo) {
            File::delete("public/".$photo->image);
            $photo->delete();
        }
        foreach ($photos as $key => $image) {
            $albumImage = new AlbumPhoto();
            $imageName = $album->id .$key. '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/albums/' . $imageName; 
            $image->move('public/images/albums', $imageName); 
            $albumImage->album_id = $album->id;
            $albumImage->image = $imagePath; 
            $albumImage->save();
        }
    }
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::find($id);
        if (!$album) {
            abort(404);
        }
        foreach ($album->photos as $photo) {
            File::delete("public/".$photo->image);
            $photo->delete();
        }
        $album->delete();
        return redirect("/");
    }

    public function move(Request $request,$id){
        $deletedAlbum= Album::find($id);
        
        $movingToAlbum =Album::where("name",$request->name)->first();
        foreach ($deletedAlbum->photos as $key => $image) 
        {
            $albumImage = new AlbumPhoto();
            $albumImage->album_id = $movingToAlbum->id;
            $albumImage->image = $image->image; 
            $albumImage->save();
        }
        $deletedAlbum->delete();
        return redirect("/");
    }
}
