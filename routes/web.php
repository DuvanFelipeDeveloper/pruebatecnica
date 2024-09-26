<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\StoreController;
use App\Models\Categories;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function(){
    Route::get('/categories',[CategoryController::class,'list'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'creating'])->name('categories.creating');
    Route::delete('/categories/{id}',[CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/edit/{id}',[CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/update/{id}',[CategoryController::class, 'update'])->name('categories.update');
});

Route::middleware('auth')->group(function(){
    Route::get('/products',[ProductController::class,'list'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'creating'])->name('products.creating');
    Route::delete('/products/{id}',[ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/edit/{id}',[ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/update/{id}',[ProductController::class, 'update'])->name('products.update');
});

Route::middleware('auth')->group(function(){
    Route::get('/store',[StoreController::class,'store'])->name('store');
    Route::post('/store',[StoreController::class,'filter'])->name('store.filter');

});

Route::middleware('auth')->group(function(){
    Route::get('/cajero',[SaldoController::class,'cajero'])->name('cajero');
    Route::post('/cajero',[SaldoController::class,'retiro'])->name('cajero.retiro');

});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
