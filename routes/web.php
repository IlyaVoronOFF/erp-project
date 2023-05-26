<?php

use App\Http\Controllers\ObjectsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ObjectPartsController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\PartUserController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SpecialsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Route::get('/demo', function () {
//     return view('layouts.demo');
// })->name('demo');

//pages
Route::group(['as' => 'pages.', 'middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('name');
    Route::resource('objects', ObjectsController::class);
    Route::resource('object-parts', ObjectPartsController::class);
    Route::resource('part-user', PartUserController::class);
    Route::resource('users', UsersController::class)->middleware('admin');
    Route::resource('clients', ClientsController::class)->middleware('admin');
    Route::resource('parts', PartsController::class)->middleware('admin');
    Route::resource('stages', StagesController::class)->middleware('admin');
    Route::resource('rules', RulesController::class)->middleware('admin');
    Route::resource('speciality', SpecialsController::class)->middleware('admin');
});
Auth::routes();