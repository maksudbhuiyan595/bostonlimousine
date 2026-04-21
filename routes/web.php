<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Models\BlogPost;
use App\Models\City;
use Illuminate\Support\Facades\Route;


Route::controller(AppController::class)->group(function () {
    Route::get('/', 'home');

});
