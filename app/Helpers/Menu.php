<?php


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;


if (!function_exists("active_menu_any")) {

    function active_menu_any(array $routes, $class = null): ?string
    {
        foreach ($routes as $route){
            if (Str::contains( active_menu_route(),$route)){
                return get_active_menu_class($class);
            }
        }
        return null;
    }
}

if (!function_exists("active_menu")) {

    function active_menu($page, $class = null): ?string
    {
        if (Str::contains( active_menu_route(),$page)){
            return get_active_menu_class($class);
        }

        return null;
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


if (!function_exists("tree_menu")) {
    function tree_menu($title, $icon, $sub_menu = null, $options = []): string
    {
        $urls = $sub_menu ? groupArr($sub_menu, 'url') : [];

        $open_class = $sub_menu ? active_menu_any($urls, 0) : null;

        $active_class = $sub_menu ? active_menu_any($urls, 1) : active_menu($options['url'], 1);

        $single_menu_url = $sub_menu ? "#" : route($options['route']);

        $html = "";
        $perm = !$options['permission'] || auth()->user()->hasPermission($options['permission']);
        if ($perm) {
            $html .= '<li class="nav-item ' . $open_class . '">';
            $html .= '<a href="' . $single_menu_url . '" class="nav-link ' . $active_class . '">';
            $html .= '<i class="nav-icon ' . $icon . '"></i>';
            $html .= '<p>';
            $html .= trans('menu.' .ucfirst($title));
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
                        $html .= '<p>' . trans('menu.' .ucfirst(groupArr($sub_menu, 'title')[$key])) . '</p>';
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
                'permission' => menu_key_exists($menu, 'permission'),
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
            return ['grouped' => $item[$index]];
        });
        return $grouped->get("grouped")->all();
    }
}

if (!function_exists("orders_count")) {

    function orders_count(): string
    {
        return "5";
//        return (string)Order::where("status","pending")->count();
    }
//
}
