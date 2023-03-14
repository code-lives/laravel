<?php

use App\Http\Controllers\IndexController;
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
Route::get("orm/first", [IndexController::class, "onefirst"]);
Route::get("orm/hasone", [IndexController::class, "hasonefirst"]);
Route::get("orm/faqhasmany", [IndexController::class, "faqhasmany"]);
Route::get("orm/faqhasmanywhere", [IndexController::class, "faqhasmanywhere"]);
Route::get("orm/userbelongto", [IndexController::class, "userbelongto"]);
Route::get("orm/userbelongtomany", [IndexController::class, "userbelongtomany"]);
