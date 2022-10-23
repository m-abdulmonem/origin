<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {



    echo get_dashboard_menu();

    $data = [
        'price' => [
            [
                '1',
                '150'
            ],
            [
                '1',
                '200'
            ],
            [
                '1',
                '300'
            ],
        ]
    ];

    foreach ($data as $datum){
        foreach ($datum as $item){
            echo "input : " . $item[0] . ", price : " .  $item[1] . "<br>";
        }
    }

//    return view('welcome');
});


// ['prefix' => 'dashboard','as' => 'dashbaord.'];
Route::prefix("dashboard")->name("dashboard.")->group(function ()
{
    Auth::routes(['register' => false]);
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
