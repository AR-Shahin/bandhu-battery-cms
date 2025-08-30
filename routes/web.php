<?php

use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\HomeController;



Route::get('/',[HomeController::class,"index"])->name("home");
Route::get('/about-us',[HomeController::class,"about"])->name("about");
Route::get('/services',[HomeController::class,"services"])->name("services");
Route::get('/contact',[HomeController::class,"contact"])->name("contact");
Route::post('/contact-store',[HomeController::class,"contactStore"])->name("contact_store");
Route::get('/product',[ProductController::class,"index"])->name("product");
Route::get('/single-product/{product:slug}',[ProductController::class,"product"])->name("single_product");



Route::get('/dashboard', function () {
    return redirect()->route("admin.dashboard");
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
require __DIR__.'/admin/auth.php';
require __DIR__.'/admin/web.php';






Route::get("sub-category-by-main-category/{category}",[GlobalController::class,"getSubCategoryByMainCategory"])->name("book-category-by-main-category");
