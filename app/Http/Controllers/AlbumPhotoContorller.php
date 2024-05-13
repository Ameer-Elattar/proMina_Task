<?php

namespace App\Http\Controllers;

use App\Models\AlbumPhoto;
use Illuminate\Http\Request;

class AlbumPhotoContorller extends Controller
{
    public function showAlbumImages(Request $request, $id){
        $images=AlbumPhoto::where("album_id", $id)->get();
        return view("album.showImages",["images" => $images]);
    }
}
