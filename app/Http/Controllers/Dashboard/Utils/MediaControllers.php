<?php

namespace App\Http\Controllers\Dashboard\Utils;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaCollection;
use App\Models\Utils\Media;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaControllers extends Controller
{

    /**
     * upload media and attach with model
     *
     * @param Request $request
     * @param $model
     * @return null
     */
    public static function addMedia(Request $request, $model)
    {
        if ($request->media) {
            foreach ($request->media as $key => $media) {
                $newMedia = (new self)->_upload($media, $request, $key);
                $newMedia->synchMedia($model);
            }
        }

        return null;
    }

    /**
     * link media with other models
     *
     * @param Request $request
     * @param $model
     * @return void
     */
    public static function attachMedia(Request $request, $model): void
    {
        if ($media = $request->media_ids) {
            $ids = explode(",", $media);
            if (is_array($ids)) {
                foreach ($ids as $id)
                    Media::find($id)->synchMedia($model);
            } else {
                Media::find($media)->synchMedia($model);
            }
        }
    }

    /**
     *
     * get all media
     *
     * @param Request $request
     * @param Media $media
     * @return MediaCollection
     */
    public function media(Request $request, Media $media): MediaCollection
    {

        return new MediaCollection($media->latest()->get());
    }

    /**
     * only upload media to server
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        if ($request->media) {
            foreach ($request->media as $key => $media) {
                $this->_upload($media, $request, $key);
            }
            return response()->json(['success' => 1, 'msg' => "file\s uploaded"]);
        }
        return response()->json(['success' => 0, 'msg' => "no file\s uploaded"]);
    }

    /**
     * handle uploaded media to store in database and server
     *
     * @param $media
     * @param $request
     * @param $key
     * @return mixed
     */
    private function _upload($media, $request, $key): mixed
    {

        $addedMedia = Media::create((new self)->data($media, $request, $key));

        $name = (new self)->name($media);


        $request->file("media")[$key]->move($this->public_path(("assets/media/")), $name);

        $final_path = "assets/media/" . $name;

        $addedMedia->path = $final_path;

        $addedMedia->save();


        return $addedMedia;
    }

    /**
     * get database columns and data
     *
     * @param $media
     * @param $request
     * @return array
     */
    private function data($media, $request, $key): array
    {
        return [
            'name' => $media->getClientOriginalName(),
            'size' => number_format($request->media[$key]->getSize() / 1048576, 2),
            'exten' => $media->extension(),
            'type' => $media->getClientMimeType(),
            'tmp_name' => $media->getPathName(),
            'caption' => '',
            'link' => '',
            'path' => ""
        ];
    }

    /**
     * create new for new file
     *
     * @param $media
     * @return string
     */
    private function name($media): string
    {
        $name = str_replace([" ", "", "-", "/", "'", "\"", ":"], "_", now() . "_" . strtolower(str_rand(6)));

        $ext = $media->extension();

        return "ma_$name.$ext";
    }

    /**
     * get assets path of project
     *
     * @param $path
     * @return string
     */
    public function public_path($path): string
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }

    /**
     * remove media
     *
     * @param Media $media
     * @return JsonResponse
     */
    public function destroy(Request $request,Media $media): JsonResponse
    {
        $path = $this->public_path($media->path);

        if (is_file($path)) {
            try {
                unlink($path);
                foreach ($media->model($request->model)->get() as $model) {
                    $model->delete();
                }
                $media->delete();
                return response()->json(['success' => 1, 'msg' => trans("Media Was Deleted Successfully")]);
            } catch (Exception $exception) {
                return response()->json(['exception' => $exception]);
            }
        }
        return response()->json(['success' => 0, 'msg' => trans("Media Doest exists")]);
    }


}
