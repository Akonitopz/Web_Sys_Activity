<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payroll;

class DashboardApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_employees' => Employee::count(),
            'total_payrolls' => Payroll::count(),
            'total_amount_paid' => Payroll::sum('net_salary'),
            'latest_payroll' => Payroll::latest()->first(),
        ]);
    }
}