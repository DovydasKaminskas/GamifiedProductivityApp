<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return redirect()->route('show.index');
});

Route::get('/index', [GameController::class, 'showIndex'])->name('show.index');
Route::get('/dashboard', [GameController::class, 'showDashboard'])->name('show.dashboard')->middleware('auth');
Route::get('/leaderboard', [GameController::class, 'showLeaderboard'])->name('show.leaderboard');
Route::get('/howToPlay', [GameController::class, 'showHowToPlay'])->name('show.howToPlay');
//Route::get('/createTask', [GameController::class, 'showTaskCreate'])->name('show.TaskCreate')->middleware('auth');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login',  'login')->name('login');
});

Route::middleware('auth')->controller(TaskController::class)->group(function () {
    Route::get('/createTask', 'create')->name('createTask');
    Route::post('/storeTask', 'store')->name('storeTask');
    Route::get('/editTask/{id}', 'edit')->name('editTask');
    Route::put('updateTask/{id}', 'update')->name('updateTask');
    Route::delete('/destroyTask/{id}', 'destroy')->name("destroyTask");
});

Route::get('/destroyTask/{id}', function () {
    return redirect()->route('login');
});
Route::get('/updateTask/{id}', function () {
    return redirect()->route('login');
});
Route::get('/storeTask', function () {
    return redirect()->route('login');
});
