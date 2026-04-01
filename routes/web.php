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
    Route::resource('projects', ProjectController::class);
    // Payment Routes
    Route::get('/invoices/{invoice}/payment-form', [InvoiceController::class, 'paymentForm'])->name('invoices.payment-form');
    Route::post('/invoices/{invoice}/payment-form', [InvoiceController::class, 'processPayment'])->name('invoices.process-payment');
    // Sending an invoice.
    Route::patch('/invoices/{invoice}/send', [InvoiceController::class, 'send'])->name('invoices.send');
});



Route::resource('users', UserController::class)->middleware(['role:super_admin']);

Route::get('/download-invoice/{invoice}', [InvoiceController::class, 'download'])->name('invoices.download');

Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');


// This is just a test route I'm using to try some different eloquent filters for displaying invoices.
Route::get('/invoices-test', [invoiceController::class, 'invoiceTest'])->name('invoices.test.index');
