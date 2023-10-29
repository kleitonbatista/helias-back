<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('category')->group(function () {
    Route::get('/list', [CategoryController::class, 'list']);
    Route::get('list/ativos',[CategoryController::class, 'listAtivos']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    Route::get('/find/{id}',[CategoryController::class, 'find']);
});

Route::prefix('item')->group(function () {
    Route::get('/list', [ItemController::class, 'list']);
    Route::post('/store', [ItemController::class, 'store']);
    Route::delete('/destroy/{id}', [ItemController::class, 'destroy']);
    Route::get('/find-code/{code}',[ItemController::class, 'findCode']);
    Route::get('/find-code-helias/{code}',[ItemController::class, 'findCodeHelias']);
    Route::get('/find-id/{id}',[ItemController::class, 'findByid']);
});


Route::get('/ping', function () {
    return "pong";
});
