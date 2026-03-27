<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);

    Route::get('payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
    Route::get('payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
    Route::post('payrolls', [PayrollController::class, 'store'])->name('payrolls.store');
    Route::post('payrolls/generate', [PayrollController::class, 'generate'])->name('payrolls.generate');
    Route::get('payrolls/{payroll}', [PayrollController::class, 'show'])->name('payrolls.show');
    Route::get('payrolls/{payroll}/edit', [PayrollController::class, 'edit'])->name('payrolls.edit');
    Route::patch('payrolls/{payroll}', [PayrollController::class, 'update'])->name('payrolls.update');
    Route::patch('payrolls/{payroll}/pay', [PayrollController::class, 'markAsPaid'])->name('payrolls.pay');
    Route::delete('payrolls/{payroll}', [PayrollController::class, 'destroy'])->name('payrolls.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
