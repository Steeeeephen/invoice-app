<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/login', [HomeController::class, 'login'])->name('login');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');



Route::middleware(['role:admin,super_admin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::patch('/invoices/{invoice}/send', [InvoiceController::class, 'send'])->name('invoices.send');
    Route::resource('projects', ProjectController::class);
});



Route::resource('users', UserController::class)->middleware(['role:super_admin']);

Route::get('/download-invoice/{invoice}', [InvoiceController::class, 'download'])->name('invoices.download');

Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
