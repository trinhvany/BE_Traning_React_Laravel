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

Route::group([
	'middleware' => 'api',
], function ($router) {
	Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
	Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
	Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
	Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
	Route::get('/user-profile', [App\Http\Controllers\AuthController::class, 'userProfile']);
	Route::post('/change-pass', [App\Http\Controllers\AuthController::class, 'changePassWord']);
});


//Faculty
Route::get('data-faculty', [App\Http\Controllers\FacultiesController::class, 'index']);
Route::post('create-faculty', [App\Http\Controllers\FacultiesController::class, 'store']);
Route::put('update-faculty', [App\Http\Controllers\FacultiesController::class, 'update']);
Route::get('data-faculty/{id}', [App\Http\Controllers\FacultiesController::class, 'show']);
Route::post('delete-faculty', [App\Http\Controllers\FacultiesController::class, 'destroy']);
Route::post('delete-mutiple', [App\Http\Controllers\FacultiesController::class, 'deleteMutiple']);

//Major
Route::get('data-major', [App\Http\Controllers\MajorController::class, 'index']);
Route::get('data-major-trash', [App\Http\Controllers\MajorController::class, 'listMajorWithTrashed']);
Route::get('data-major-by-faculty/{id}', [App\Http\Controllers\MajorController::class, 'showList']);
Route::get('data-major/{id}', [App\Http\Controllers\MajorController::class, 'show']);
Route::post('create-major', [App\Http\Controllers\MajorController::class, 'store']);
Route::put('update-major', [App\Http\Controllers\MajorController::class, 'update']);
Route::post('delete-major', [App\Http\Controllers\MajorController::class, 'destroy']);
Route::post('delete-mutiple', [App\Http\Controllers\MajorController::class, 'deleteMutiple']);

//Student
Route::get('data-student', [App\Http\Controllers\StudentsController::class, 'index']);
Route::get('data-student/{id}', [App\Http\Controllers\StudentsController::class, 'show']);
Route::post('create-student', [App\Http\Controllers\StudentsController::class, 'store']);
Route::put('update-student', [App\Http\Controllers\StudentsController::class, 'update']);
Route::post('delete-student', [App\Http\Controllers\StudentsController::class, 'destroy']);
Route::post('delete-all-student', [App\Http\Controllers\StudentsController::class, 'deleteMutiple']);
