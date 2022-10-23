<?php

use Illuminate\Support\Facades\Route;
use Mabdulmonem\Uploader\Http\Controllers\MediaControllers;

Route::group(['prefix' => 'media'], function () {

//    Route::get('/', [MediaControllers::class, "media"])->name("uploader.media.index");
    Route::get('/', function (){
        return view("uploader::uploader");
    })->name("uploader.media.index");
    Route::post('upload', [MediaControllers::class, "upload"])->name("uploader.media.upload");
    Route::delete('{media}', [MediaControllers::class, "destroy"])->name("uploader.media.destroy");
});
