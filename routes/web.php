<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Responders\ShowHomeResponder;
use App\Http\Responders\ShowPostResponder;
use App\Models\WinkPostProxy;

Route::feeds();

Route::get('/posts/{post:slug}', [ShowPostResponder::class, 'handle'])->name('show-post');
Route::get('/', [ShowHomeResponder::class, 'handle'])->name('show-home');

Route::get('/post/{post:slug}', function(WinkPostProxy $post) {
    return redirect()->route('show-post', $post->slug);
});
