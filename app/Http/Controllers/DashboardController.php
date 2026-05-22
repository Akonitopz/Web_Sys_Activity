<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        $totalPayrolls = Payroll::count();

        $totalAmountPaid = Payroll::sum('net_salary');

        $latestPayroll = Payroll::latest()->first();

        return view('dashboard', compact(
            'totalEmployees',
            'totalPayrolls',
            'totalAmountPaid',
            'latestPayroll'
        ));
    }
}