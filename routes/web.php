<?php

use App\Http\Controllers\NotificationController;
use App\Models\Message;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

// Notification Read_all_notification
Route::get('Read_notification_message/{id}',[NotificationController::class,'Read_notification_message'])->name('Read_notification_message');
Route::get('Read_all_notification',[NotificationController::class,'Read_all_notification'])->name('Read_all_notification');


Route::get('dashboard/chat', function () {
    return view('layouts.chat');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
