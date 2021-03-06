<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\MainController;
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
    return view('welcome');
});

/** Admin Panel */
Route::prefix('')->name('panel.')->group(function($router) {
    $router->get('', [MainController::class, 'index'])->name('feeds.index');
    $router->get('get-updates', [MainController::class, 'getUpdates'])->name('feeds.get.updates');

    $router->get('requests', [MainController::class, 'requests'])->name('requests.index');

});
