<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;

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

Route::middleware('auth:api')->group(function(){
    Route::post('/update', [DataController::class, 'update']);
    // Route::post('/reset', [DataController::class, 'reset']); 
    Route::post('/upload/file', [DataController::class, 'uploadFile']); 
    Route::post('/add/slide', [DataController::class, 'addSlide']);   
    Route::post('/delete/slide', [DataController::class, 'deleteSlide']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::get('/get', [DataController::class, 'get']);
