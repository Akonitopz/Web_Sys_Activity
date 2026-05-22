<?php
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\PayrollHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('employees', EmployeeController::class);    
    Route::resource('payrolls', PayrollController::class);
    Route::get('/payroll-history', [PayrollHistoryController::class, 'index'])
    ->name('payroll.history');
    Route::get('/audit-logs', [AuditLogController::class, 'index'])
    ->name('audit.logs');
    
});

require __DIR__.'/auth.php';
