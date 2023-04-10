<?php

use App\Http\Controllers\Api\ItemController;
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

//get all items
Route::get('items',[ItemController::class, 'index']);  

//post all items
Route::post('items',[ItemController::class, 'store']);  

//get item by id
Route::get('items/{id}',[ItemController::class, 'display']);  

//edit item by id
Route::get('items/{id}/edit', [ItemController::class, 'edit']);

//update item by id
Route::put('items/{id}/edit',[ItemController::class, 'update']);

//delete item by id
Route::delete('items/{id}/delete',[ItemController::class, 'dispose']);
