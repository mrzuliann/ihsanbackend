<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\API\ApiBerita;

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::get('/apiberita',  [App\Http\Controllers\API\PresensiController::class, 'berita']);
//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    // Route::get('/user', [App\Http\Controller\API\PresensiController::class, 'GetUsers']);
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('/get-presensi',  [App\Http\Controllers\API\PresensiController::class, 'getPresensis']);
    Route::get('/presensihour',  [App\Http\Controllers\API\PresensiController::class, 'presensiHour']);
    Route::get('/holidays',  [App\Http\Controllers\API\PresensiController::class, 'holidays']);
    Route::get('/galery',  [App\Http\Controllers\API\PresensiController::class, 'galery']);
    Route::get('/event',  [App\Http\Controllers\API\PresensiController::class, 'event']);
    Route::get('/broadcast',  [App\Http\Controllers\API\PresensiController::class, 'broadcast']);
    Route::post('/loginsession',  [App\Http\Controllers\API\PresensiController::class, 'loginsession']);
    Route::get('/laporan',  [App\Http\Controllers\API\PresensiController::class, 'laporan']);

    Route::post('masuk-presensi', [App\Http\Controllers\API\PresensiController::class, 'masukPresensi']);
    Route::post('pulang-presensi', [App\Http\Controllers\API\PresensiController::class, 'masukPresensiv2']);

    Route::get('get-sekolah', [App\Http\Controllers\API\PresensiController::class, 'GetSekolah']);
});
