<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegistration']);


Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/profile', [ProfileController::class, 'showForm'])->name('profile.show');
  Route::post('/profile', [ProfileController::class, 'saveProfile'])->name('profile.save');


  // Rute untuk halaman pembuatan transaksi
  Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
  Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

  // Rute untuk menampilkan detail transaksi
  Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/', [AuthController::class, 'redirectToLogin']);
});