<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // All products.
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Create a new product.
    Route::post('/products/add', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/add', [ProductController::class, 'add'])->name('products.add');

    // View a single product.
    Route::get('/products/{product}/view', [ProductController::class, 'view'])->name('products.view');

    // Edit a single product.
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}/edit', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/edit', [ProductController::class, 'destroy'])->name('products.destroy');

    // Delete an image from a product.
    Route::delete('/products/{product}/delete-image', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
});

require __DIR__.'/auth.php';
