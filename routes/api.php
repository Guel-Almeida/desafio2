<?php


use App\Http\Controllers\Api\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(SchoolController::class)->group(function () {
    Route::post('/school', 'store');
    Route::get('/schools', 'index');
    Route::get('/schools/{id}', 'show');
    Route::delete('/schools/{id}','destroy');
    Route::put('/school/{id}','update');
  });
