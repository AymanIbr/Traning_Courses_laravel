<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware('auth')->group(function(){
Route::get('/',[AdminController::class , 'index'])->name('Dashboord');
Route::resource('stores',StoreController::class);
Route::resource('products',ProductController::class);
Route::get('all-registration',[ProductController::class , 'registration'])->name('registration');
Route::delete('all-registration/{id}',[ProductController::class , 'registrationDelete'])->name('registration.destroy');
});

// Home Page
Route::get('/',[PagesController::class , 'index'])->name('homePage');
//Search
Route::post('/search',[PagesController::class , 'search'])->name('search');
//Course
Route::get('product/{slug}',[PagesController::class , 'product'])->name('product');
//Register
Route::get('purchase/{slug}',[PagesController::class , 'purchase'])->name('purchase');
Route::post('purchars/{slug}',[PagesController::class , 'purcharsSubmit']);
//pay
Route::get('pay/{id}',[PagesController::class , 'pay'])->name('pay');
Route::get('thanks/{id}',[PagesController::class , 'thanks'])->name('thanks');

//contact
Route::get('contact',[PagesController::class , 'contact'])->name('contact');
Route::post('contact',[PagesController::class , 'contactSubmit'])->name('contactSubmit');


// Route::get(function)



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
