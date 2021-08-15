<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/dashboard/book',  [BookController::class, 'index'])->name('book');
Route::get('/dashboard/find',  [BookController::class, 'find'])->name('find');
Route::post('/dashboard/show',  [BookController::class, 'show'])->name('show');
Route::get('/dashboard/create',  [BookController::class, 'create'])->name('create');
Route::post('/dashboard/store',  [BookController::class, 'store'])->name('store');
Route::get('/dashboard/update/{id}', [BookController::class, 'view'])->name('update');
Route::post('/dashboard/save',  [BookController::class, 'save'])->name('save');
Route::get('/dashboard/delete/{id}', [BookController::class, 'delete'])->name('delete');

Route::get('/dashboard/softdelete', [BookController::class, 'paparsoftdelete'])->name('softdelete');
Route::get('/dashboard/restore/{id}', [BookController::class, 'restore'])->name('restore');

// email
route::get('/dashboard/email', function () {
    $data = [
        'name' => 'Abd Malik',
        'email' => 'mrabdmalik@gmail.com'
    ];
    Mail::to($data['email'])->send(new App\Mail\WelcomeEmail(
        $data
    ));
    return new App\Mail\WelcomeEmail($data);
})->name('email');

// yajra datatable
Route::get('/dashboard/yajra', [BookController::class, 'yajradt'])->name('yajradt');

// upload image
Route::get('/dashboard/client',[ClientController::class,'index'])->name('client');
Route::get('/dashboard/client/create',[ClientController::class,'create'])->name('client.create');
Route::post('/dashboard/client/store',[ClientController::class,'store'])->name('client.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

