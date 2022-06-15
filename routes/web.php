<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.'
    ], function() {
        Route::get('tasks', [App\Http\Controllers\Admin\TaskController::class,'index'])->name('tasks.index');
        Route::get('tasks/create', [App\Http\Controllers\Admin\TaskController::class,'create'])->name('tasks.create');
        Route::get('tasks/edit', [App\Http\Controllers\Admin\TaskController::class,'update'])->name('tasks.edit');
        Route::delete('tasks/{task}', [App\Http\Controllers\Admin\TaskController::class,'destroy']);
        Route::post('tasks/store', [App\Http\Controllers\Admin\TaskController::class,'store']);
        Route::get('tasks/completed', [App\Http\Controllers\Admin\TaskController::class, 'completed'])->name('completed');
        Route::post('tasks/comment/{task}', [App\Http\Controllers\Admin\TaskController::class, 'comment']);
        Route::post('tasks/approve/{task}', [App\Http\Controllers\Admin\TaskController::class, 'approve']);
    });

    Route::group([
        'prefix' => 'user',
        'as' => 'user.'
    ], function(){
        Route::get('tasks', [App\Http\Controllers\User\TaskController::class, 'index'])->name('tasks.index');
        Route::post('tasks/completed/{task}', [App\Http\Controllers\User\TaskController::class, 'completed']);
        Route::get('tasks/comments', [App\Http\Controllers\User\TaskController::class, 'comments']);
    });

    
});


