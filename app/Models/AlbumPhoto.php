<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumPhoto extends Model
{
    use HasFactory;

    protected $fillable = ["album_id","image"] ;

    public function albums(){
        return $this->belongsTo(Album::class);
    }
}
