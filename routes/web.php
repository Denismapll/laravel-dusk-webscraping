<?php

use App\Http\Controllers\DuskController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/executar-teste-dusk', [DuskController::class, 'runDuskTest']);

