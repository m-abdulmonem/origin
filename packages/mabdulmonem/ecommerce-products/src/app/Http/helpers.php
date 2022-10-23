<?php


if (! function_exists("assets")){
    function assets($path): string
    {
        $assets = "uploader/assets/";

        $extension = array_reverse(explode(".", $path));

        return asset($assets . $extension[0] . "/$path");
    }
}
