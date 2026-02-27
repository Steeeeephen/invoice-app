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



Route::middleware(['admin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::patch('/invoices/{invoice}/send', [InvoiceController::class, 'send'])->name('invoices.send');
    Route::resource('projects', ProjectController::class);

});



Route::resource('users', UserController::class);
