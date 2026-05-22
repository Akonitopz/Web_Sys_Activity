<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalPayrolls = Payroll::count();
        $totalAmountPaid = Payroll::sum('net_salary');
        $latestPayroll = Payroll::latest()->first();

        $employeesByDepartment = Employee::select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->get();

        $payrollByMonth = Payroll::select('month', DB::raw('sum(net_salary) as total'))
            ->groupBy('month')
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'totalPayrolls',
            'totalAmountPaid',
            'latestPayroll',
            'employeesByDepartment',
            'payrollByMonth'
        ));
    }
}