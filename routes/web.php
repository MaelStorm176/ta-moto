<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
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

require __DIR__.'/auth.php';

Route::get('/', static function () {
    return redirect()->route('home');
});

Route::group(['prefix' => 'home'], static function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
});


Route::get('/chatbot/messages', [ChatbotController::class, 'messages'])->name('chatbot.messages');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], static function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::post('/', [ProfileController::class, 'update']);
});

Route::group(['prefix' => 'shop'], static function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/motos/{motorbike}', [ShopController::class, 'show'])->name('shop.show');
    Route::get('/categories/{category}', [ShopController::class, 'showCategory'])->name('shop.showCategory');
});

Route::group(['prefix' => 'forum', 'middleware' => 'auth'], static function () {
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/channels/{channel}', [ForumController::class, 'showChannel'])->name('forum.showChannel');
    Route::delete('/channels/{channel}', [ForumController::class, 'quitChannel'])->name('forum.quitChannel');
    Route::get('/channels/{channel}/messages/{message}', [ForumController::class, 'showMessage'])->name('forum.showMessage');
    Route::post('/channels/{channel}/messages', [ForumController::class, 'addMessage'])->name('forum.addMessage');
});

Route::group(['prefix' => 'notifications', 'middleware' => 'auth'], static function () {
    Route::get('/stream', [NotificationController::class, 'stream'])->name('notifications.stream');
    Route::post('{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
});

Route::group(['prefix' => 'communication', 'middleware' => 'auth'], static function () {
    Route::get('/', [CommunicationController::class, 'index'])->name('communication.index');
});

Route::group(['prefix' => 'admin'], static function () {
    Voyager::routes();
});
