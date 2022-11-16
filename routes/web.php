<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware(['auth'])->group( function () {
//     // User needs to be authenticated to enter here.
//     Route::get('list',[ContactController::class,'show'])->middleware('verified');

//     Route::post("list",[ContactController::class,'add']);

//     Route::get("list/{id}",[ContactController::class,'index']);

//     Route::post("list/update",[ContactController::class,'update']);

//     Route::get("share/{id}",[UrlController::class,'url_share']);

//     Route::get("url/{id}", [UrlController::class, 'url'])->name('url')->middleware('signed');

//     Route::get('export', [ContactController::class, 'export'])->name('export');

//     Route::get('add', [ContactController::class, 'add_form']);

// });

Route::middleware(['isLoggedIn'])->group( function () {

    Route::get('dashboard',[ContactController::class,'show']);

    Route::post("dashboard",[ContactController::class,'add']);

    Route::get("dashboard/{id}",[ContactController::class,'index']);

    Route::post("dashboard/update",[ContactController::class,'update']);

    Route::get("share/{key}",[UrlController::class,'url_share']);

    Route::post("share/{key}",[UrlController::class,'url_gen']);

    Route::get('update/{id}', [ContactController::class, 'update_form']);

    Route::get('add', [ContactController::class, 'add_form']);
});


Route::get("url/{key}", [UrlController::class, 'url'])->name('url')->middleware('signed');

Route::get('export', [ContactController::class, 'export'])->name('export');
//yt->middleware('isLoggedIn');

Route::get('login1',[CustomAuthController::class,'login'])->name('login1');

Route::get('register1',[CustomAuthController::class,'registration'])->name('register1');

Route::post('register-user',[CustomAuthController::class,'registerUser']);

Route::post('login-user',[CustomAuthController::class,'loginUser']);

// Route::get('dashboard',[ContactController::class,'dashboard']);

/* Newly Added Routes */
// Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']); 
Route::get('account/verify/{token}', [CustomAuthController::class, 'verifyAccount'])->name('user.verify'); 

Route::get('logout',[CustomAuthController::class,'logout']);