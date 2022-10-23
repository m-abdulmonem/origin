<?php

use App\Models\Setting\Setting;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

if (!function_exists("is_email")) {
    function is_email($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
}




if (!function_exists("admin")) {
    function admin(): ?Authenticatable
    {
        return auth()->guard('dashboard')->user();
    }
}

if (!function_exists("title")) {

    function title($title): array|string|Translator|Application|null
    {
        $text = isset($title) ? trans("menu.".ucfirst($title)) . " |" : "";

        return "$text MA";
    }
}

if (!function_exists('get_breadcrumb')) {

    /**
     * Get [Breadcrumb]
     *
     * @param null $title
     * @return string|null
     */
    function get_breadcrumb($title = null): ?string
    {
        $pages = _breadcrumb_pages();

        $html = "";

        if (request()->segment(1) == "dashboard") {
            $html .= '<li class="breadcrumb-item active"><a href="' . route('dashboard.index') . '">Home</a></li>';
        }

        $prev = '';

        foreach ($pages as $page) {

            $url = $prev ? "$prev/$page" : $page . "s";

            $prev = $page;

            $response = checkRoute("dashboard/$url") ? url("dashboard/$url") : "#";

            $a = strtolower($title) != $page ? "<a href='$response'>" . ucwords($page) . "</a>" : ucwords($title);

            $html .= "<li class='breadcrumb-item'>$a</li>";
        }


        return strtolower($title) == $prev ? $html : $html . "<li class='breadcrumb-item'>" . ucwords($title) . "</li>";
    }
}



if (!function_exists("_breadcrumb_pages")) {

    function _breadcrumb_pages(): array
    {
        $words = ['dashboard', 'create', 'edit'];

        $subject = implode("/", request()->segments());

        if (str_contains($subject, 'editor')) {
            unset($words[2]);
        }

        $pages = str_replace($words, "", $subject);
        /**
         * /[0-9]/
         */
//        $pages = preg_replace('/d/', '', $pages);
        $pages = preg_replace('/[0-9]/', '', $pages);

        return explode("/", trim($pages, '/'));
    }
}


if (!function_exists("checkRoute")) {
    function checkRoute($route): bool
    {
        $routes = Route::getRoutes();
        $request = Request::create($route);
        try {
            $routes->match($request);
            return true;
        } catch (NotFoundHttpException $e) {
            return false;
        }
    }
}

if (!function_exists('settings')) {

    /**
     * get site [Settings]
     *
     * @param null $key
     * @return mixed
     */
    function settings($key = null): mixed
    {
        if ($key) {
            return Setting::where("key", $key)->first();
        }
        return Setting::all();
    }
}


if (!function_exists('image')) {

    /**
     * Store Images Or Files to Server
     * get Save [Image] or [file] by file name
     * get old [image] when update
     *
     *
     * @param $name
     * @param bool $get_img
     * @param null $update
     * @param string $folder_name
     * @return UrlGenerator|string|null
     */
    function image($name, bool $get_img, $update = null, string $folder_name = 'images'): UrlGenerator|string|null
    {
        if (!request()->hasFile($name) && $update)
            return $update;
        if (request()->hasFile($name) && !$get_img) {
            request()->validate([
                $name => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000'
            ]);
            return request()->file($name)->store($folder_name, 'public');
        }
        if ($get_img) {
            return (str_contains($name, 'images') || str_contains($name, 'companies_logo'))
                ? asset('storage/' . $name)
                : admin_assets("AdminLTELogo.png");
        }
        return null;
    }
}


//if (!function_exists("file_upload")) {
//
//    /**
//     * @param $input
//     * @param $folder
//     * @param bool $admin
//     * @param null $path
//     * @param null $title
//     * @return string|null
//     */
//    function file_upload($input, $folder, bool $admin = false, $path = null, $title = null): ?string
//    {
//        if ($input) {
//            $title = $title ?? uniqid();
//
//            $imageName = time() . "_" . str_replace([" ", "", "-", "/", "'", "\""], "_", strtolower($title)) . "." . $input->extension();
//            $adminFolder = $admin ? "dashboard" : "frontend";
//            $input->move(public_path(($path ?? "assets/$adminFolder/img/$folder/uploaded")), $imageName);
//
//            return ($path ?? "img/$folder/uploaded/") . $imageName;
//        }
//        return null;
//    }
//}


if (!function_exists("select_options")) {

    /**
     * select
     *
     * @param object $options
     * @param null $old
     * @param null $update
     * @param array $attr
     * @return string
     */
    function select_options(object $options, $old = null, $update = null, array $attr = []): string
    {
        $html = '';
        if (!empty($attr)) {
            $id = $attr['key'];
            foreach ($options as $obj) {
                $html .= "<option value='" . $obj->$id . "' " . (($obj->$id == 0 || $obj->$id == old($old) || $update === $obj->$id) ? "selected" : "") . ">" . get_properties($obj, $attr['data']) . "</option>";
            }
        } else {
            foreach ($options as $key => $option) {
                $html .= "<option value='$key' " . (($key == 0 || $key == old($old) || $update === $key) ? "selected" : "") . ">$option</option>";
            }
        }
        return $html;
    }
}

if (!function_exists("get_properties")) {
    function get_properties($obj, $properties): void
    {
        foreach ($properties as $property)
            echo $obj->$property;
    }
}





if (!function_exists("str_rand")) {
    function str_rand(int $length = 64)
    { // 64 = 32
        $length = ($length < 4) ? 4 : $length;
        return bin2hex(random_bytes(($length - ($length % 2)) / 2));
    }
}


if (!function_exists("request_merge")) {

    /**
     * array $data this the extendable data to merge
     *
     * Request $request this is the request var
     */
    function request_merge(array $data = [], Request $request = null): array
    {
        global $globalRequest;

        $req = ($request ?? $globalRequest)?->all() ?? [];

        return array_merge($req, $data);
    }
}


if (!function_exists("checkbox_val_bool")) {


    function checkbox_val_bool($value = '', $text = "on"): bool
    {
        return ($value != null && $value == $text);
    }
}

