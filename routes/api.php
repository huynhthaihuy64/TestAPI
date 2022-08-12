<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\Api\ConfirmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Page
Route::get('/index/login', [PageController::class, 'login'])->name('login');
Route::post('/index/login', [PageController::class, 'postLogin'])->name('postLogin');
Route::get('/index/register', [PageController::class, 'register'])->name('register');
Route::post('/index/register', [PageController::class, 'store'])->name('register.store');
Route::get('/index/submit-cv', [CvController::class, 'create'])->name('cv.create');
Route::post('/index/submit-cv', [CvController::class, 'store'])->name('cv.store');
Route::get('/index/forgot', [PageController::class, 'forgot'])->name('forgot');
Route::post('/index/forgot', [PageController::class, 'postForgot'])->name('postForgot');
Route::get('/index/reset/{token}', [PageController::class, 'getPassword'])->name('getPassword');
Route::post('/index/reset/{token}', [PageController::class, 'updatePassword'])->name('updatePassword');

Route::get('user/list', [UserController::class, 'index'])->name('user.list');
Route::get('user/edit/{id}', [UserController::class, 'show'])->name('user.show');
Route::post('user/edit/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.del'); //Muốn dùng Route::delete thì ở form action nên thêm route và @method 'Delete'

Route::get('cv/list', [CvController::class, 'index'])->name('cv.list');
Route::get('cv/edit/{id}', [CvController::class, 'show'])->name('cv.show');
Route::post('cv/edit/{id}', [CvController::class, 'update'])->name('cv.update');
Route::get('cv/delete/{id}', [CvController::class, 'destroy'])->name('cv.del');
Route::get('cv/mail/{email}', [CvController::class, 'sendmail'])->name('cv.mail');


Route::get('confirm/list', [ConfirmController::class, 'index'])->name('confirm.list');
Route::get('confirm/create', [ConfirmController::class, 'create'])->name('confirm.create');
Route::post('confirm/create', [ConfirmController::class, 'store'])->name('confirm.store');
Route::delete('confirm/delete/{id}', [ConfirmController::class, 'destroy'])->name('confirm.del');
Route::get('confirm/mail/{email}&&{date}', [ConfirmController::class, 'acceptInterview'])->name('confirm.accept');
Route::get('confirm/mail/pass/{email}&&{name}', [ConfirmController::class, 'passInterview'])->name('confirm.pass');
Route::get('confirm/mail/fail/{email}&&{name}', [ConfirmController::class, 'failInterview'])->name('confirm.fail');
