<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\Api\ConfirmController;
use App\Http\Controllers\API\EmployeeAuthor;
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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('employee/register', [EmployeeAuthor::class, 'register'])->name('employee.register');
Route::post('employee/login', [EmployeeAuthor::class, 'login'])->name('employee.login');
Route::group(['middleware' => 'auth:api'], function () {

    //employee
    Route::get('employee', [EmployeeAuthor::class, 'employee']);

    //User: Done
    Route::group(['prefix' => 'users', 'as' => 'users'], function () {
        Route::post('register', [UserController::class, 'create'])->name('.create');
        Route::get('list', [UserController::class, 'index'])->name('.list');
        Route::get('edit/{id}', [UserController::class, 'show'])->name('.show');
        Route::post('edit/{id}', [UserController::class, 'update'])->name('.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('.del');
    });

    //cv
    Route::group(['prefix' => 'cvs', 'as' => 'cvs'], function () {
        Route::post('register', [CvController::class, 'create'])->name('.create');
        Route::get('list', [CvController::class, 'index'])->name('.list');
        Route::get('edit/{id}', [CvController::class, 'show'])->name('.show');
        Route::post('edit/{id}', [CvController::class, 'update'])->name('.update');
        Route::delete('delete/{id}', [CvController::class, 'destroy'])->name('.del');
        Route::get('mail/{email}', [CvController::class, 'sendmail'])->name('.mail');
    });

    //confirmCV
    Route::group(['prefix' => 'confirms', 'as' => 'confirms'], function () {
        Route::get('list', [ConfirmController::class, 'index'])->name('.list');
        Route::post('create', [ConfirmController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [ConfirmController::class, 'show'])->name('.show');
        Route::put('edit/{id}', [ConfirmController::class, 'update'])->name('.update');
        Route::delete('delete/{id}', [ConfirmController::class, 'destroy'])->name('.del');
        Route::get('mail/{email}&&{date}', [ConfirmController::class, 'acceptInterview'])->name('.accept');
        Route::get('mail/pass/{email}', [ConfirmController::class, 'passInterview'])->name('.pass');
        Route::get('mail/fail/{email}', [ConfirmController::class, 'failInterview'])->name('.fail');
    });
});
