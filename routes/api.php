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

Route::middleware('language')->group(function () {
    Route::post('employees/register', [EmployeeAuthor::class, 'register'])->name('employee.register');
    Route::post('employees/login', [EmployeeAuthor::class, 'login'])->name('employees.login');
    Route::group(['middleware' => 'auth:api'], function () {


        //employee
        Route::group(['prefix' => 'employees', 'as' => 'employees'], function () {
            Route::get('', [EmployeeAuthor::class, 'employee'])->name('.show');
            Route::get('list', [EmployeeAuthor::class, 'index'])->name('.list');
            Route::get('logout', [EmployeeAuthor::class, 'logout'])->name('.logout');
        });

        //User: Done
        Route::group(['prefix' => 'users', 'as' => 'users'], function () {
            Route::post('create', [UserController::class, 'create'])->name('.create');
            Route::get('list', [UserController::class, 'index'])->name('.list');
            Route::get('edit/{id}', [UserController::class, 'show'])->name('.show');
            Route::put('edit/{id}', [UserController::class, 'update'])->name('.update');
            Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('.del');
            Route::get('sheet', [UserController::class, 'insertSheet'])->name('.sheet');
            Route::get('sheet/list', [UserController::class, 'getSheet'])->name('.sheet_list');
            Route::get('sheet/update', [UserController::class, 'updateSheet'])->name('.sheet_update');
            Route::post('forgot', [UserController::class, 'postForgot'])->name('.forgot');
            Route::post('forgot/update', [UserController::class, 'updatePassword'])->name('.forgot_update');
        });

        //cv
        Route::group(['prefix' => 'cvs', 'as' => 'cvs'], function () {
            Route::post('create', [CvController::class, 'create'])->name('.create');
            Route::get('list', [CvController::class, 'index'])->name('.list');
            Route::get('edit/{id}', [CvController::class, 'show'])->name('.show');
            Route::put('edit/{id}', [CvController::class, 'update'])->name('.update');
            Route::delete('delete/{id}', [CvController::class, 'destroy'])->name('.del');
            Route::get('mail/{email}', [CvController::class, 'sendmail'])->name('.mail');
            Route::get('sheet', [CvController::class, 'appendCvSheets'])->name('.sheet');
        });

        //confirmCV
        Route::group(['prefix' => 'confirms', 'as' => 'confirms'], function () {
            Route::get('list', [ConfirmController::class, 'index'])->name('.list');
            Route::post('create', [ConfirmController::class, 'create'])->name('.create');
            Route::get('edit/{id}', [ConfirmController::class, 'show'])->name('.show');
            Route::put('edit/{id}', [ConfirmController::class, 'update'])->name('.update');
            Route::delete('delete/{id}', [ConfirmController::class, 'destroy'])->name('.del');
            Route::get('mail/{email}', [ConfirmController::class, 'acceptInterview'])->name('.accept');
            Route::get('mail/pass/{email}', [ConfirmController::class, 'passInterview'])->name('.pass');
            Route::get('mail/fail/{email}', [ConfirmController::class, 'failInterview'])->name('.fail');
            Route::get('sheet', [ConfirmController::class, 'appendConfirmSheets'])->name('.sheet');
        });
    });
});
