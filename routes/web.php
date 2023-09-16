<?php

use App\Http\Controllers\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/{id1}/{id2}', function () {
//     return view('welcome');
// });
// Route::get('/{category}/{product}', function (Request $request, $category, $product) {
//     dd($category, $product, $request);
//     return view('welcome');
// });
// Route::group(['middleware'=>'auth'], function () {
//     // /products = admin/products
//     // /categories
// });
Route::resource('cs', C::class);
