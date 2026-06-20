<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Models\BlogPost;
use App\Models\City;
use Illuminate\Support\Facades\Route;


Route::controller(AppController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/step2', 'step2')->name('step2');
    Route::get('/step3', 'step3')->name('step3');
    Route::get('/step4', 'step4')->name('step4');
    Route::get('/airports', 'airport')->name('airports');
    Route::get('/capacity-luggage', 'capacityLuggage')->name('luggage.capacity');
    Route::get('about/', 'about')->name('about');
    Route::get('/taxi-with-child-car-seats', 'childSeat')->name('child.seat');
    Route::get('/pickup-location-12', 'pickupLocation')->name('pickup.location');
    Route::get('/reservation', 'reservation')->name('reservation');
    Route::get('/minivan', 'minivan')->name('minivan');
    Route::get('/long-distance-car-service-33', 'longdistance')->name('long.distance');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy.policy');
    Route::get('/terms&conditions', 'termConditions')->name('term.conditions');
    Route::get('/payment-policy', 'paymentPolicy')->name('payment.policy');
    Route::get('/area-service', 'areService')->name('area.service');
    Route::get('/setting', 'setting')->name('setting');
    Route::post('/book-confirm', 'confirmBooking')->name('book.confirm');
});
Route::get('/{slug}', [RouteController::class, 'index'])->name('dynamic.route');
