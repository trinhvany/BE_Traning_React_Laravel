<?php

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

Route::group(['middleware' => 'api',], function ($router) {
	Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
	Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
	Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
	Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
	Route::get('/user-profile', [App\Http\Controllers\AuthController::class, 'userProfile']);
	Route::post('/change-pass', [App\Http\Controllers\AuthController::class, 'changePassWord']);
});


//Faculty
Route::get('data-name-faculty', [App\Http\Controllers\FacultiesController::class, 'index']);
Route::get('data-faculty', [App\Http\Controllers\FacultiesController::class, 'getData']);
//Major
Route::get('data-major', [App\Http\Controllers\MajorController::class, 'index']);
Route::get('data-major-by-faculty/{id}', [App\Http\Controllers\MajorController::class, 'show']);
//Student
Route::get('data-student', [App\Http\Controllers\StudentsController::class, 'index']);
Route::get('data-student/{id}', [App\Http\Controllers\StudentsController::class, 'show']);
Route::post('create-student', [App\Http\Controllers\StudentsController::class, 'store']);
Route::put('update-student', [App\Http\Controllers\StudentsController::class, 'update']);
Route::post('delete-student', [App\Http\Controllers\StudentsController::class, 'destroy']);
Route::post('delete-all-student', [App\Http\Controllers\StudentsController::class, 'deleteMutiple']);
