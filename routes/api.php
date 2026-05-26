<?php
use App\Http\Controllers\Api\AuditLogApiController;
use App\Http\Controllers\Api\AttendanceApiController;
use App\Http\Controllers\Api\PayrollApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\DashboardApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardApiController::class, 'index']);

    Route::get('/user', function () {
        return request()->user();});
        
    Route::get('/employees', [EmployeeApiController::class, 'index']);

    Route::get('/payrolls', [PayrollApiController::class, 'index']);

    Route::get('/payrolls/{id}', [PayrollApiController::class, 'show']);

    Route::get('/attendances', [AttendanceApiController::class, 'index']);

    Route::get('/attendance-employees', [AttendanceApiController::class, 'employees']);

    Route::post('/attendances', [AttendanceApiController::class, 'store']);

    Route::get('/audit-logs', [AuditLogApiController::class, 'index']);

});