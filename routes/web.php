<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return view('guestPages.home', ['log' => 0]);
})->name('home');
Route::get('language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
});
Route::get('detail/language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect(url()->previous());
});
Route::get('updaterole/language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect(url()->previous());
});
Route::get('/login', [AuthController::class, 'login_page'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register_page'])->name('register')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login_create');
Route::post('/register', [AuthController::class,'register'])->name('register_create');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('unregistered');
Route::get('/welcome', [HomeController::class, 'auth_home'])->name('welcome')->middleware('unregistered');
Route::get('/detail/{id}', [HomeController::class, 'item_detail'])->name('detail')->middleware('unregistered');
Route::post('/buy', [ItemController::class, 'add_cart'])->name('buy')->middleware('unregistered');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart')->middleware('unregistered');
Route::post('/delcart', [ItemController::class ,'del_cart'])->name('del_cart')->middleware('unregistered');
Route::post('/checkout', [ItemController::class, 'cout'])->name('cout')->middleware('unregistered');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware('unregistered');
Route::post('/updateprofile', [HomeController::class, 'update_profile'])->name('update_profile')->middleware('unregistered');
Route::get('/maintanance', [AdminController::class, 'maintanance'])->name('maintanance')->middleware('admin');
Route::get('/updaterole/{id}', [AdminController::class, 'update_role'])->name('uprole')->middleware('admin');
Route::post('/changerole', [AdminController::class, 'change_role'])->name('chrole')->middleware('admin');
Route::post('/delacc', [AdminController::class, 'del_acc'])->name('dell_acc')->middleware('admin');
