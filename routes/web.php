<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function(){
    return Inertia::render('Home');
})->name('home');


Route::get('/mystore',function(){
    return Inertia::render('Store');
})->middleware(['auth'])->name('myStore');

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard',[ProductController::class,'show'])->name('dashboard');
    Route::get('/dashboard/addproduct',[ProductController::class,'create'])->name('productadd');
    Route::post('/dashboard/addproductTenant',[ProductController::class,'store'])->name('add.productadd');
    Route::post('/dashboard/{product}',[ProductController::class,'update'])->name('update.product');
    Route::delete('/dashboard/{product}',[ProductController::class,'destroy'])->name('delete.product');
});

Route::post('/transaction',[TransactionController::class,'store'])->middleware('auth')->name('add.transaction');

require __DIR__.'/auth.php';
