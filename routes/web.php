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
Route::get("es/info", [ElasticSearch::class, "infos"]); //ES信息
Route::get("es/create_ik", [ElasticSearch::class, "esCreateIk"]); // 创建分词索引
Route::get("es/delete", [ElasticSearch::class, "esDelete"]); //删除索引的里面的某条数据
Route::get("es/indexDelete", [ElasticSearch::class, "indexDelete"]); //删除索引
Route::get("es/esCreateIkData", [ElasticSearch::class, "esCreateIkData"]); //插入数据
Route::get("es/eaCreateIkDataBulk", [ElasticSearch::class, "eaCreateIkDataBulk"]); //批量插入数据
Route::get("es/esIkSearch", [ElasticSearch::class, "esIkSearch"]); //返回所有数据
Route::get("es/esIkSearchWhere", [ElasticSearch::class, "esIkSearchWhere"]); //加查询条件，返回所有数据



// Redis队列
Route::get("redis/transaction", [RedisController::class, "transaction"]);
