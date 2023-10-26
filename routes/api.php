<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::prefix('auth')->group(function(){
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('auth')->name('auth.')->group(function(){
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('user')->name('user.')->group(function(){
       Route::get('/', [UserController::class, 'index'])->name('index');
       Route::put('/', [UserController::class, 'update'])->name('update');
       Route::get('/{user}', [UserController::class, 'getOne'])->name('get');
       Route::delete('/{user}', [UserController::class, 'deleteForce'])->name('delete');
    });

});



