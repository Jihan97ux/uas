<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchedulerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::prefix('event')->name('event.')->group(function(){
    Route::get('/', [SchedulerController::class, 'home'])->name('home');
    Route::post('submit', [SchedulerController::class, 'submit'])->name('submit');

    // Existing routes for update and delete
    Route::post('/update', [SchedulerController::class, 'update'])->name('update');
    Route::post('/delete', [SchedulerController::class, 'delete'])->name('delete');
    Route::get('/get-event/{id}', [SchedulerController::class, 'getSelectedData']);
    Route::get('/get-json', [SchedulerController::class, 'getJson'])->name('get-json');

    // Add this route for getting event data in JSON format
    // Route::get('/get-json', [SchedulerController::class, 'getJson'])->name('get-json');
});
