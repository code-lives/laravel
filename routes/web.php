<?php

use App\Http\Controllers\ElasticSearch;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RedisController;
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
// ORM 
Route::get("orm/first", [IndexController::class, "onefirst"]);
Route::get("orm/hasone", [IndexController::class, "hasonefirst"]);
Route::get("orm/faqhasmany", [IndexController::class, "faqhasmany"]);
Route::get("orm/faqhasmanywhere", [IndexController::class, "faqhasmanywhere"]);
Route::get("orm/userbelongto", [IndexController::class, "userbelongto"]);
Route::get("orm/userbelongtomany", [IndexController::class, "userbelongtomany"]);

// elasticsearch
Route::get("es/info", [ElasticSearch::class, "infos"]);
Route::get("es/create", [ElasticSearch::class, "esCreate"]);
Route::get("es/query", [ElasticSearch::class, "esQuery"]);
Route::get("es/delete", [ElasticSearch::class, "esDelete"]);

// Redis队列
Route::get("redis/transaction", [RedisController::class, "transaction"]);
