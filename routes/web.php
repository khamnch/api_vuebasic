<?php
use App\Http\Controllers\ProductController;
use App\http\Controllers\OrderController;
use App\http\Contrllers\OrderDetailController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products',ProductController::class);
Route::resource('orders',OrderController::class);
// Route::resource('orderdetails', [App\http\Contrllers\OrderDetailController::class]);
Route::get('/search',[App\Http\Controllers\ProductController::class,'search']);
Route::get('slides',[App\Http\Controllers\SlideController::class,'index'])->name('create');