<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\PayrollHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::get('/payrolls', [PayrollController::class, 'index'])
        ->name('payrolls.index');

    Route::get('/payroll-history', [PayrollHistoryController::class, 'index'])
        ->name('payroll.history');

    Route::resource('attendances', AttendanceController::class)
        ->only(['index', 'create', 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::middleware(['admin'])->group(function () {

        Route::get('/employees/create', [EmployeeController::class, 'create'])
            ->name('employees.create');

        Route::post('/employees', [EmployeeController::class, 'store'])
            ->name('employees.store');

        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('employees.edit');

        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
            ->name('employees.update');

        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
            ->name('employees.destroy');

        Route::get('/payrolls/create', [PayrollController::class, 'create'])
            ->name('payrolls.create');

        Route::post('/payrolls', [PayrollController::class, 'store'])
            ->name('payrolls.store');

        Route::get('/payrolls/{payroll}/payslip', [PayslipController::class, 'show'])
            ->name('payrolls.payslip');

        Route::get('/audit-logs', [AuditLogController::class, 'index'])
            ->name('audit.logs');
    });

});

require __DIR__.'/auth.php';