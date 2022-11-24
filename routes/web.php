<?php

use App\Http\Controllers\ShopController;
use App\Models\Motorbike;
use App\Models\MotorbikeCategory;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/home', function () {
    $categories = MotorbikeCategory::all();
    $motos = Motorbike::where('price', '>', 0)
        ->orderBy('price', 'asc')
        ->limit(3)
        ->get();
    return view('home', compact('categories', 'motos'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/{slug}', [ShopController::class, 'show'])->name('shop.show');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
