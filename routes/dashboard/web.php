<?php


use App\Http\Controllers\ClientEnd\Auth\LoginController;
use App\Http\Controllers\Dashboard\Appearance\PagesController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Products\ProductsController;
use App\Http\Controllers\Dashboard\Services\ServiceController;
use App\Http\Controllers\Dashboard\Utils\MediaControllers;
use Illuminate\Support\Facades\Route;


$prefix = "dashboard.";


Route::group(["middleware" => ["auth"]], function () use ($prefix) {

    Route::get('/', [HomeController::class, "index"])->name(str_replace(".", "", $prefix));
    Route::view('/test', "welcome")->name(str_replace(".", "", $prefix));
    Route::get('/collection', function (){

        dd((string)(\App\Models\Product\Orders::where("status","pending")->count()));
//        dd(\Illuminate\Support\Facades\Config::get("menus"));
        $collect = collect([
            [
                'url' => 'products',
                'route' => 'products.index',
                'title' => 'Products'
            ],
            [
                'url' => 'services',
                'route' => 'services.index',
                'title' => 'Services'
            ],
            [
                'url' => 'services',
                'route' => 'services.index',
                'title' => 'Services'
            ],
        ]);
        $titles = $collect->mapToGroups(function ($item, $key) {
            return [
                'titles' => $item['title']
            ];
        });
        $urls = $collect->mapToGroups(function ($item, $key) {
            return [
                'urls' => $item['url']
            ];
        });
        $routes = $collect->mapToGroups(function ($item, $key) {
            return [
                'routes' => $item['route']
            ];
        });

        print_r(  groupArr($collect,'url'));
        return  groupArr($collect,'route');
//        return $grouped->get("urls")->all();
//        return $grouped->all();

    })->name(str_replace(".", "", $prefix));

    Route::get("orders",function (){

    })->name("orders");

    Route::group([], function () {

        Route::resource('products', ProductsController::class);
        Route::get('products/json/index', [ProductsController::class, 'json'])->name("products.json.index");

    });
    Route::group([], function () {

        Route::resource('services', ServiceController::class);
        Route::get('services/json/index', [ServiceController::class, 'json'])->name("services.json.index");

    });

    Route::group(["prefix"=> "appearance"], function () {
        Route::view('/', "dashboard.pages.appearance.index")->name("appearance");
        Route::group([],function (){
            Route::resource('pages', PagesController::class);
            Route::get('pages/json/index', [PagesController::class, 'json'])->name("pages.json.index");

        });
    });

    Route::group(['prefix' => 'media'], function () {

        Route::get('media', [MediaControllers::class, "media"])->name("dashboard.media.index");
        Route::post('upload', [MediaControllers::class, "upload"])->name("dashboard.media.upload");
    });

    //logout
    Route::get('logout', [LoginController::class, 'logout'])->name($prefix . 'logout');


});
