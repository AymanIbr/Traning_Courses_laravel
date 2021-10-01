<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware('auth')->group(function(){
Route::get('/',[AdminController::class , 'index'])->name('Dashboord');
Route::resource('categories',CategoryController::class);
Route::resource('courses',CourseController::class);
Route::get('all-registration',[CourseController::class , 'registration'])->name('registration');
Route::delete('all-registration/{id}',[CourseController::class , 'registrationDelete'])->name('registration.destroy');
});

// Home Page
Route::get('/',[PagesController::class , 'index'])->name('homePage');
//Search
Route::post('/search',[PagesController::class , 'search'])->name('search');
//Course
Route::get('course/{slug}',[PagesController::class , 'course'])->name('course');
//Register
Route::get('register/{slug}',[PagesController::class , 'register'])->name('register');
Route::post('register/{slug}',[PagesController::class , 'registerSubmit']);
//pay
Route::get('pay/{id}',[PagesController::class , 'pay'])->name('pay');
Route::get('thanks/{id}',[PagesController::class , 'thanks'])->name('thanks');

//contact
Route::get('contact',[PagesController::class , 'contact'])->name('contact');
Route::post('contact',[PagesController::class , 'contactSubmit'])->name('contactSubmit');






Auth::routes(['register'=> false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
