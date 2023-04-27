<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
 
Route::get('/user/{id}', [UserController::class, 'show']);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/quote', function () {
//     return 'Knowledge is more powerful than money!';
// });
// Route::get('/users/{id}-{name}',function($id,$name){
//     return "this is the user id:$id and its name:$name";
// });

// THE MAIN view :
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PagesController::class,'index']);
Route::get('/about', [PagesController::class,'about']);
Route::get('/services', [PagesController::class,'services']);
Route::get('/posts', [PagesController::class,'posts']);

// Route::get('/about',function(){
//     return view('pages.about');
// });

Route::resource('posts', PostsController::class);
Route::post('posts', [PostsController::class,'store'])->name('posts.store');

Auth::routes();

// Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
