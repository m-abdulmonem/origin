<?php

use App\Models\Product\Orders;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Config;
if (!function_exists("is_email")) {
    function is_email($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
}


if (!function_exists("_assets")) {
    function _assets($path, $folder, $plugin = null, bool $fullPath = false): string
    {
        $assets = "assets/$folder/";
        $imgTypes = ['jpeg', 'jpg', 'png', 'ico', 'svg'];
        $extension = array_reverse(explode(".", $path));

        if ($fullPath) {
            return asset($assets . "plugin/$plugin/$path");
        }
        if ($plugin) {
            $pluginFolder = is_string($plugin) ? $plugin : $extension[count($extension) - 1];
            return asset($assets . "plugin/$pluginFolder/" . $extension[0] . "/$path");
        }
        if (in_array($extension[0], $imgTypes)) {
            return asset($assets . "img/$path");
        }
        return asset($assets . $extension[0] . "/$path");
    }
}

if (!function_exists("admin_assets")) {
    function admin_assets($path, $plugin = null, bool $fullPath = false): string
    {
        return _assets($path, "dashboard", $plugin, $fullPath);
    }
}

if (!function_exists("frontend_assets")) {
    /**
     * @param $path
     * @param string|null $plugin
     * @param false $fullPath
     * @return string
     */
    function frontend_assets($path, string $plugin = null, bool $fullPath = false): string
    {
        return _assets($path, "frontend", $plugin, $fullPath);
    }
}
if (!function_exists("admin")) {
    function admin(): ?Authenticatable
    {
        return auth()->guard('dashboard')->user();
    }
}
if (!function_exists("title")) {
    function title(): string
    {
        return (isset($title) ? "$title - " : "") . " MA";
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
        $pages = array_merge(_breadcrumb_pages(), [$title]);

        if (request()->segment(1) == "dashboard") {
            echo '<li class="breadcrumb-item active"><a href="' . url('/') . '">Home</a></li>';
        }

        for ($i = 0; $i < count($pages); $i++) {
            if ($i != count($pages) - 1) {
                $url = url("dashboard/" . request()->segment($i + 2) . "/");

                echo "<li class='breadcrumb-item'><a href='$url'>" . ucfirst($pages[$i]) . "</a></li>";
            }
        }
        echo "<li class='breadcrumb-item'>" . ucfirst($title) . "</li>";
        return null;
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
        $pages = preg_replace('/d/', '', $pages);

        return explode("/", trim($pages, '/'));
    }
}

//if (!function_exists('settings')){
//
//    /**
//     * get site [Settings]
//     *
//     * @param $property
//     * @param bool $action
//     * @param array $data
//     * @return mixed
//     */
//    function settings($property = null, bool $action = false,array  $data = []){
//        $settings = Setting::orderBy('id','DESC')->first();
//        if ($action)
//            return $settings
//                ? $settings->update($data)
//                : Setting::create($data);
//        return $settings ? Setting::orderBy('id','DESC')->first()->$property : false;
//    }
//}


if (!function_exists("active_menu_any")) {

    function active_menu_any(array $routes, $class = null): ?string
    {
        $res = "";
        foreach ($routes as $route)
            $res = active_menu($route, $class);

        return $res;
    }
}
if (!function_exists("active_menu")) {

    function active_menu($page, $class = null): ?string
    {
        return ($page == active_menu_route())
            ? get_active_menu_class($class)
            : null;
    }
}

if (!function_exists("active_menu_home")) {

    function active_menu_home($class = null): ?string
    {
        return (!active_menu_route())
            ? get_active_menu_class($class)
            : null;
    }
}

if (!function_exists("active_menu_route")) {

    function active_menu_route(): string
    {
        $arr = ['create', 'edit', "dashboard"];

        $route = implode("/", request()->segments());

        if ($route == "dashboard/appearance/editor") {
            unset($arr[1]);
        }

        $route = str_replace($arr, "", $route);

//        return trim(preg_replace("/d/","",$route),"/");
        return trim($route, "/");
    }
}

if (!function_exists("get_active_menu_class")) {

    function get_active_menu_class($class): string
    {
        $classes = ['menu-open', 'active'];

        return $classes[$class];
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


if (!function_exists("datatable_files")) {
    /**
     * get datatable js files
     *
     * @param string $file_type
     * @return void
     */
    function datatable_files(string $file_type = "js"): void
    {
        if ($file_type == "css")
            echo '<!-- DataTables -->
                <link rel="stylesheet" href="' . admin_assets("datatable/dataTables.bootstrap4.min.css") . '">
                 <link rel="stylesheet" href="' . admin_assets("datatable/responsive.dataTables.min.css") . '">';

        if ($file_type == "js")
            echo '  <!-- DataTables -->
                <script src="' . admin_assets("datatable/jquery.dataTables.min.js") . '"></script>
                <script src="' . admin_assets("datatable/dataTables.bootstrap4.min.js") . '"></script>
                <script src="' . admin_assets("datatable/table.js") . '"></script>';

    }
}// end of datatable_files

if (!function_exists("btn_delete")) {
    /**
     *
     * @param $url
     * @param $data
     * @param null $property
     * @param bool $back
     * @param null $title
     * @return string
     */
    function btn_delete($url, $data, $property = null, $title = null, bool $back = false): string
    {
        return '<button class="btn btn-danger btn-delete " type="button"
                       data-url="' . route("$url.destroy", $data->id) . '"
                       data-name="' . ($property ? $data->$property : $data->name) . '"
                       data-token="' . csrf_token() . '"
                       data-title="Are you Sure"
                       data-text="Delete ' . ($property ? $data->$property : $data->name) . '"
                       ' . ($back ? 'data-back=' . route("$url.index") : null) . '>
                       <i class="fa fa-trash"></i> ' . ($title ? "Delete $title" : null) . '</a>';
    }
}

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


if (!function_exists("file_upload")) {

    /**
     * @param $input
     * @param $folder
     * @param bool $admin
     * @param null $path
     * @param null $title
     * @return string|null
     */
    function file_upload($input, $folder, bool $admin = false, $path = null, $title = null): ?string
    {
        if ($input) {
            $title = $title ?? uniqid();

            $imageName = time() . "_" . str_replace([" ", "", "-", "/", "'", "\""], "_", strtolower($title)) . "." . $input->extension();
            $adminFolder = $admin ? "dashboard" : "frontend";
            $input->move(public_path(($path ?? "assets/$adminFolder/img/$folder/uploaded")), $imageName);

            return ($path ?? "img/$folder/uploaded/") . $imageName;
        }
        return null;
    }
}


if (!function_exists("get_template_files")) {
    function _get_template_files($dir, $level): array
    {
        $files = [];
        foreach (scandir($dir) as $file) {
            if ($file == '.' || $file == '..') continue;
            if (is_file($file)) {
                $files[] = [
                    'level' => $level,
                    'name' => $file,
                    'path' => "$dir/$file"
                ];
            }
        }
        return $files;
    }

}

if (!function_exists("_directories_data")) {

    /**
     * @param $dir
     * @param $file
     * @param $level
     * @return array
     */
    function _directories_data($dir, $file, $level): array
    {
        if (is_dir($dir)) {
            $children = expandDirectoriesMatrix($dir, $level + 1);
            $files = _get_template_files($dir, $level);
        } else {
            $children = null;
            $files = null;
        }
        return [
            'level' => $level,
            'name' => $file,
            'path' => $dir,
            'children' => $children,
            'files' => $files,
            'is_file' => !is_dir($dir) //(!$children && !$files)
        ];
    }
}

if (!function_exists("expandDirectoriesMatrix")) {
    function expandDirectoriesMatrix($base_dir, $level = 0): array
    {
        $directories = [];
        foreach (scandir($base_dir) as $file) {
            if ($file == '.' || $file == '..') continue;
            $dir = $base_dir . DIRECTORY_SEPARATOR . $file;
            $directories[] = _directories_data($dir, $file, $level);
        }
        return $directories;
    }
}

if (!function_exists("file_tree")) {
    function file_tree($folder, bool $recursive = false): string
    {
        $extensions = ['.', 'blade', 'php', 'css', 'js', 'min', 'png', 'gif', 'jpg', 'svg', 'jpeg'];
        $html = '<table class="table table-hover"><tbody>';
        if ($folder['is_file']) {
            $html .= '<tr><td class="border-0 file" data-path="' . $folder['path'] . '">' . str_replace($extensions, "", $folder['name']) . '  <i class="fa fa-minus btn-delete-file float-right"></i></td></tr>';
        } else {
            $html .= '<tr data-widget="expandable-table" aria-expanded="false">
                        <td data-path="' . $folder['path'] . '" class="folder">
                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                            ' . $folder['name'] . '

                            <i class="fa fa-minus btn-delete-file float-right"></i>
                            <i class="fa fa-plus btn-add-file float-right mr-2"></i>
                        </td>
                    </tr>';
            $html .= file_tree_files($folder, $extensions);
        }
        $html .= $recursive ? '' : '</tbody></table>';
        return $html;
    }
}
if (!function_exists("file_tree_files")) {
    function file_tree_files($folder, $extensions): string
    {
        $html = '<tr class="expandable-body d-none">';
        $html .= '<td>';
        $html .= '<div class="p-0" style="display: none;">';
        $html .= '<table class="table table-hover">';
        $html .= '<tbody>';
        foreach ($folder['children'] as $file) {
            if ($file['is_file']) {
                $html .= '<tr><td class="file" data-path="' . $file['path'] . '">' . str_replace($extensions, "", $file['name']) . '  <i class="fa fa-minus btn-delete-file float-right"></i></td></tr>';
            } else {
                $html .= file_tree($file, true);
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
        return implode(',', array_unique(explode(',', $html)));
    }
}

if (!function_exists("delete_dir")) {

    function delete_dir($dirPath): void
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (!str_ends_with($dirPath, '/')) {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                delete_dir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}


if (!function_exists("get_title")) {

    function get_title()
    {
        global $title, $file;

        $text = isset($title) ? "$title |" : "";

        $text = "$text AdminLTE";

        $name = isset($file) ? "$file.$text" : $text;

        return trans($name);
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
    function request_merge(array $data = [], Request $request = null)
    {
        global $globalRequest;

        $req = ($request ?? $globalRequest)?->all() ?? [];

        return array_merge($req, $data);
    }
}


if (!function_exists("checkbox_val_bool")) {


    function checkbox_val_bool($value = '', $text = "on")
    {
        return ($value != null && $value == $text);
    }
}


if (!function_exists("tree_menu")) {
    function tree_menu($title, $icon, $sub_menu = null, $options = []): string
    {
//        $url = null, $route = null, $badge = null

        $urls = $sub_menu ? groupArr($sub_menu, 'url') : [];

        $open_class = $sub_menu ? active_menu_any($urls, 0) : null;

        $active_class = $sub_menu ? active_menu_any($urls, 1) : active_menu($options['url'], 1);

        $single_menu_url = $sub_menu ? "#" : route($options['route']);

        $html = "";
        $perm = $options['permission']? auth()->user()->hasPermission($options['permission']) : true;
        if ($perm){
            $html .= '<li class="nav-item ' . $open_class . '">';
            $html .= '<a href="' . $single_menu_url . '" class="nav-link ' . $active_class . '">';
            $html .= '<i class="nav-icon ' . $icon . '"></i>';
            $html .= '<p>';
            $html .= trans(ucfirst($title));
            $html .= $sub_menu ? '<i class="right fas fa-angle-left"></i>' : null;
            $html .= $options['badge'] && orders_count() > 0 ? '<span class="badge badge-info right">' . orders_count() . '</span>' : null;
            $html .= '</p>';
            $html .= '</a>';
            if ($sub_menu) {
                $html .= '<ul class="nav nav-treeview">';
                foreach (groupArr($sub_menu, 'route') as $key => $route) {
                    $perm = groupArr($sub_menu, 'permission')[$key];
                    if ($perm && auth()->user()->hasPermission($perm)) {
                        $html .= '<li class="nav-item">';
                        $html .= '<a href="' . route($route) . '" class="nav-link ' . active_menu($urls[$key], 1) . '">';
                        $html .= '<i class="far fa-circle nav-icon"></i>';
                        $html .= '<p>' . trans(ucfirst(groupArr($sub_menu, 'title')[$key])) . '</p>';
                        $html .= '</a>';
                        $html .= '</li>';
                    }
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }

        return $html;
    }
}

if (!function_exists("get_dashboard_menu")) {
    function get_dashboard_menu(): string
    {
        $menus = Config::get("menus");

        $html = "";

        foreach ($menus as $menu) {

            $options = [
                'badge' => menu_key_exists($menu, "badge"),
                'route' => menu_key_exists($menu, "route"),
                'url' => menu_key_exists($menu, "url"),
                'permission' => menu_key_exists($menu,'permission')
            ];

            $html .= tree_menu(title: $menu['title'], icon: $menu['icon'], sub_menu: menu_key_exists($menu, "sub_menu"), options: $options);
        }

        return $html;
    }
}
if (!function_exists("menu_key_exists")) {

    function menu_key_exists($menu, $key)
    {

        return array_key_exists($key, $menu) ? $menu[$key] : null;
    }
}

if (!function_exists("groupArr")) {

    function groupArr($collect, $index)
    {
        $grouped = collect($collect)->mapToGroups(function ($item, $key) use ($index) {
            return [
                'grouped' => $item[$index]
            ];
        });
        return $grouped->get("grouped")->all();
    }
}

if (! function_exists("orders_count")){

    function orders_count(){
        return (string)Orders::where("status","pending")->count();
    }
//
}
