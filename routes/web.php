<?php

use App\Http\Controllers\WatchersController;
use Illuminate\Support\Facades\Broadcast;
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

require __DIR__.'/auth.php';
Broadcast::routes();

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [WatchersController::class, 'index'])->name('dashboard');
    Route::resource('watchers', WatchersController::class)
        ->only(['index', 'store', 'destroy']);
});




