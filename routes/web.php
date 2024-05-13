<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumPhotoContorller;
use Illuminate\Support\Facades\Route;

Route::get("/", [AlbumController::class,"index"])->name('albums');
Route::get("/create", [AlbumController::class,"create"])->name('create');
Route::post("/", [AlbumController::class,"store"])->name("store");
Route::get("/edit/{id}", [AlbumController::class,"edit"])->name("edit");
Route::put("/{id}", [AlbumController::class,"update"])->name("update");
Route::delete("/{id}", [AlbumController::class,"destroy"])->name("destroy");
Route::put("/move/{id}", [AlbumController::class,"move"])->name("move");

Route::get("/album/{id}/images",[AlbumPhotoContorller::class,"showAlbumImages"])->name("showImages");
