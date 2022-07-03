<?php

namespace App\Http\Controllers\Dashboard\Utils;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaCollection;
use App\Models\Utils\Media;
use Illuminate\Http\Request;
use function App\Http\Controllers\Utils\public_path;

class MediaControllers extends Controller
{
    public static function addMedia(Request $request,$model)
    {
        if ($request->media) {
            foreach($request->media as $media){
                $newMedia = (new self)->_upload( $media,$request);
                $newMedia->syncMedia($model);
            }
        }

        return null;
    }

    public function media(Request $request,Media $media)
    {

        return new MediaCollection($media->latest()->get());
    }


    public function upload(Request $request)
    {
        if ($request->media) {
            foreach($request->media as $media){
                $this->_upload( $media,$request);
             }
        }
    }


     private function _upload($media,$request)
    {

         $addedMedia = Media::create((new self)->data( $media,$request));

        $name = (new self)->name($media);

        $request->file("media")[0]->move(public_path(("assets/media/")),$name);

        $final_path =  "assets/media/" . $name;

        $addedMedia->path = $final_path;

        $addedMedia->save();


        return $addedMedia;
    }

    private function data( $media,$request)
    {
        return [
            'name' => $media->getClientOriginalName(),
            'size' => number_format($request->media[0]->getSize() / 1048576,2),
            'exten' => $media->extension(),
            'type' => $media->getClientMimeType(),
            'tmp_name' => $media->getPathName(),
            'caption' => '',
            'link' => '',
            'path' => ""
        ];
    }

    private function name($media)
    {
        $name = str_replace([" ", "","-","/","'","\"",":"],"_",now() ."_".strtolower(str_rand(6)));

        $ext = $media->extension();

        return "ma_$name.$ext";
    }
}
