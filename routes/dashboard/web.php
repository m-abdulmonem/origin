<?php


use App\Http\Controllers\ClientEnd\Auth\LoginController;
use App\Http\Controllers\Dashboard\Appearance\AppearanceController;
use App\Http\Controllers\Dashboard\Appearance\EditorController;
use App\Http\Controllers\Dashboard\Appearance\MenusController;
use App\Http\Controllers\Dashboard\Appearance\PagesController;
use App\Http\Controllers\Dashboard\Appearance\SlidersController;
use App\Http\Controllers\Dashboard\Contact\ContactsController;
use App\Http\Controllers\Dashboard\Contact\FaqController;
use App\Http\Controllers\Dashboard\Contact\ReportsController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Services\OffersController;
use App\Http\Controllers\Dashboard\Services\OrdersController;
use App\Http\Controllers\Dashboard\Services\PlanesController;
use App\Http\Controllers\Dashboard\Services\ServiceController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\Dashboard\Users\ClientsController;
use App\Http\Controllers\Dashboard\Users\NursesController;
use App\Http\Controllers\Dashboard\Users\UsersController;
use App\Http\Controllers\Dashboard\Utils\MediaControllers;
use App\Http\Controllers\Dashboard\Utils\PermissionsController;
use Illuminate\Support\Facades\Route;


Route::group(["middleware" => ["auth"], 'as' => 'dashboard.'], function () {

    Route::get('/', [HomeController::class, "index"])->name("index");

    Route::get('/permissions', function () {

        (new PermissionsController)->run();
        return redirect(\route("dashboard.index"));
    });

//    Route::get("orders", function () {
//        $file = \App\Models\Utils\Media::find(6)->path;
//
//        $path = (new MediaControllers())->public_path($file);
//
//        dd(is_file($path));
//    })->name("orders");


    Route::group([], function () {

        Route::resource('orders', OrdersController::class);
        Route::get('orders/json/index', [OrdersController::class, 'json'])->name("services.json.index");
    });

    Route::group([], function () {

        Route::resource('subscriptions', PlanesController::class);
        Route::get('subscriptions/json/index', [PlanesController::class, 'json'])->name("services.json.index");
    });

    Route::group([], function () {

        Route::resource('offers', OffersController::class);
        Route::get('offers/json/index', [OffersController::class, 'json'])->name("services.json.index");
    });


    Route::group([], function () {

        Route::resource('services', ServiceController::class);
        Route::get('services/json/index', [ServiceController::class, 'json'])->name("services.json.index");
    });

    Route::group(["prefix" => "appearance", 'as' => 'appearance.'], function () {

        Route::view('/', "dashboard.pages.appearance.index")->name("index");

        Route::group(['prefix' => 'widgets','as' => 'widgets.'],function(){
            Route::get("/",[AppearanceController::class, "showWidgets"])->name("index");
            Route::put("/",[AppearanceController::class, "widgetsAction"])->name("action");
        });
        Route::group(['prefix' => 'editor','as' => 'editor.'],function(){
            Route::get("/",[EditorController::class, "showEditor"])->name("index");
            Route::put("/",[EditorController::class, "editorAction"])->name("action");
            Route::get("/file/open",[EditorController::class, "openFile"])->name("open.file");
            Route::post("/create",[EditorController::class, "create"])->name("create");
            Route::delete("/delete",[EditorController::class, "delete"])->name("delete");
        });

        Route::group([],function(){
            Route::resource("sliders",SlidersController::class);
            Route::get("api/sliders",[SlidersController::class, "jsonIndex"])->name("sliders.index");
        });

        Route::group([],function(){
            Route::resource("menus",MenusController::class);
            Route::get("menus/api/index",[MenusController::class, "jsonIndex"])->name("menus.json.index");
        });


        Route::group([], function () {
            Route::resource('pages', PagesController::class);
            Route::get('pages/json/index', [PagesController::class, 'json'])->name("pages.json.index");
        });
    });

    Route::group([], function () {
        Route::group([], function () {

            Route::resource('users', ClientsController::class);
            Route::get('users/json/index', [ClientsController::class, 'json'])->name("users.json.index");
        });
        Route::group([], function () {

            Route::resource('nurses', NursesController::class);
            Route::get('nurses/json/index', [NursesController::class, 'json'])->name("clients.json.index");
        });
        Route::group([], function () {

            Route::resource('clients', UsersController::class);
            Route::get('clients/json/index', [UsersController::class, 'json'])->name("clients.json.index");
        });

    });

    Route::group([], function () {
        Route::group([], function () {

            Route::resource('messages', ContactsController::class);
            Route::get('messages/json/index', [ContactsController::class, 'json'])->name("messages.json.index");
        });
        Route::group([], function () {

            Route::resource('reports', ReportsController::class);
            Route::get('reports/json/index', [ReportsController::class, 'json'])->name("reports.json.index");
        });
        Route::group([], function () {

            Route::resource('faq', FaqController::class);
            Route::get('faq/json/index', [FaqController::class, 'json'])->name("faq.json.index");
        });

    });


    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {

        Route::get('/', [SettingsController::class, "showSettingsForm"])->name("index");
        Route::post('/', [SettingsController::class, "update"])->name("update");
    });

    Route::group(['prefix' => 'media', 'as' => 'media.'], function () {

        Route::get('media', [MediaControllers::class, "media"])->name("index");
        Route::post('upload', [MediaControllers::class, "upload"])->name("upload");
        Route::delete('{media}', [MediaControllers::class, "destroy"])->name("destroy");
    });


    //logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});
