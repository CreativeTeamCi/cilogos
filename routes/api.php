<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmitLogosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/logos',[
    HomeController::class,'searchLogos'
])->name('search');

Route::get('/activities-area',[
    SubmitLogosController::class,'activitiesArea'
])->name('activities_area');

Route::get('/logos/page/{page}',[
    HomeController::class,'searchLogos'
])->name('search');

Route::get('/search-logos',[
    HomeController::class,'searchLogos'
])->name('search');

Route::get('/search-logos/{search}',[
    HomeController::class,'searchLogos'
])->name('search');

Route::get('/search-logos/page/{page}',[
    HomeController::class,'searchLogos'
])->name('search');

Route::get('/search-logos/{search}/page/{page}',[
    HomeController::class,'searchLogos'
])->name('search');

Route::post('/submission',[
    SubmitLogosController::class,'store'
])->name('submission.store');

