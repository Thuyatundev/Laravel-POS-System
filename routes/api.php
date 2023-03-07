<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Route\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('testing',[RouteController::class,'test']);
Route::get('get/Category',[RouteController::class,'categoryList']); //Read *

Route::post('create/Category',[RouteController::class,'createCategory']); //create
Route::post('create/contact',[RouteController::class,'createContact']); //create

Route::post('delete/category',[RouteController::class,'deleteCategory']); //Delete

Route::post('detail/category',[RouteController::class,'detailCategory']); //Read
Route::post('update/category',[RouteController::class,'updateCategory']); //Update