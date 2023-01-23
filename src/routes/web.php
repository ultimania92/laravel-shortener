<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ShortUrlController;

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

Route::get('/', [ShortUrlController::class, 'index'])->name('url.index');
Route::post('/', [ShortUrlController::class, 'create'])->name('url.shorten');

// For the hyper-small case, going customink.com to ci.com would be just having another domain redirect all requests that look like a uri slug to this route.
Route::get('/custom/{uri_slug}', [ShortUrlController::class, 'redirect'])->name('url.resolve');