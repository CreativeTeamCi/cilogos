<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmitLogosController;
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


//
Route::get('/',[
    HomeController::class,'index'
])->name('index');

Route::get('/submission',[
    SubmitLogosController::class,'index'
])->name('submission.index');

Route::get('/test-mail',[
    SubmitLogosController::class,'testemail'
]);

Route::post('/submission',[
    SubmitLogosController::class,'store'
])->name('submission.store');

Route::get('/test-mail', function () {
    return new App\Mail\SubmissionMail([
      'nom' => 'Alhassane',
      'email' => 'alhassanesoro96@gmail.com',
      'message' => 'Je voulais vous dire que votre site est magnifique !'
      ]);
});

