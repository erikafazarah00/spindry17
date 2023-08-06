<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [UserController::class, 'createRegister']);
Route::post('/register', [UserController::class, 'storeRegister']);

Route::get ('/login', [UserController::class, 'login'])->name(('login')); 
Route::post ('/login', [UserController::class, 'prosesLogin']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware(['auth', 'checkRole::admin']);;

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'checkRole::admin']);

Route::get('/hero', [HeroController::class, 'index'])->middleware(['auth', 'checkRole::admin']);;
Route::get('/hero/create', [HeroController::class, 'create'])->middleware(['auth', 'checkRole::admin']);;
Route::post('/hero', [HeroController::class, 'store'])->middleware(['auth', 'checkRole::admin']);;
Route::get('/hero/{hero}/edit', [HeroController::class, 'edit'])->middleware(['auth', 'checkRole::admin']);;
Route::put('/hero/{hero}', [HeroController::class, 'update'])->middleware(['auth', 'checkRole::admin']);;
Route::delete('/hero/{hero}', [HeroController::class, 'destroy'])->middleware(['auth', 'checkRole::admin']);;

Route::get('/promotion', [PromotionController::class, 'index'])->middleware(['auth', 'checkRole::admin']);;
Route::get('/promotion/create', [PromotionController::class, 'create'])->middleware(['auth', 'checkRole::admin']);;
Route::post('/promotion', [PromotionController::class, 'store'])->middleware(['auth', 'checkRole::admin']);;
Route::get('/promotion/{promotion}/edit', [PromotionController::class, 'edit'])->middleware(['auth', 'checkRole::admin']);;
Route::put('/promotion/{promotion}', [PromotionController::class, 'update'])->middleware(['auth', 'checkRole::admin']);;
Route::delete('/promotion/{promotion}', [PromotionController::class, 'destroy'])->middleware(['auth', 'checkRole::admin']);;

Route::get('/partner', [PartnerController::class, 'index'])->middleware(['auth', 'checkRole::admin']);;
Route::get('/partner/create', [PartnerController::class, 'create'])->middleware(['auth', 'checkRole::admin']);;
Route::post('/partner', [PartnerController::class, 'store'])->middleware(['auth', 'checkRole::admin']);;
Route::get('/partner/{partner}/edit', [PartnerController::class, 'edit'])->middleware(['auth', 'checkRole::admin']);;
Route::put('partner/{partner}', [PartnerController::class, 'update'])->middleware(['auth', 'checkRole::admin']);;
Route::delete('/partner/{partner}', [PartnerController::class, 'destroy'])->middleware(['auth', 'checkRole::admin']);;

// Service
Route::get('/service', [ServiceController::class, 'index'])->middleware('auth');;
Route::get('/service/create', [ServiceController::class, 'create'])->middleware('auth');;
Route::post('/service', [ServiceController::class, 'store'])->middleware('auth');;
Route::get('/service/{service}/edit', [ServiceController::class, 'edit'])->middleware('auth');;
Route::put('/service/{service}', [ServiceController::class, 'update'])->middleware('auth');;
Route::delete('/service/{service}', [ServiceController::class, 'destroy'])->middleware(['auth', 'checkRole::admin']);


// Order
Route::get('/order', [OrderController::class, 'index'])->middleware('auth');;
