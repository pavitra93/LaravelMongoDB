<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listings;
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

// index() - Show all listing
Route::get('/', [ListingsController::class, 'index']);

// create() - Show form to create new listing
Route::get('/listings/create', [ListingsController::class, 'create'])->middleware('auth');

// edit() - show form to edit listing 
Route::get('/listings/{listing}/edit', [ListingsController::class, 'edit'])->middleware('auth');

// manage() - Manage user logged in listings only
Route::get('/listings/manage', [ListingsController::class, 'manage'])->middleware('auth');

// show() - Show single listing
Route::get('/listings/{listing}', [ListingsController::class, 'show']);

// update() - Update Listing 
Route::put('/listings/{listing}', [ListingsController::class, 'update'])->middleware('auth');

// destroy() - Delete Listing 
Route::delete('/listings/{listing}', [ListingsController::class, 'destroy'])->middleware('auth');

// store() - Store new listing
Route::post('/listings', [ListingsController::class, 'store'])->middleware('auth');

// create() - Show register form to create user
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// store() - Store new user
Route::post('/users', [UserController::class, 'store']);

// store() - Store new user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// create() - Show login form to login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// login() - Login to user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
