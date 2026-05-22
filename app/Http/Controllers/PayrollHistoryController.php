<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollHistoryController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        $query = Payroll::with('employee');

        if ($request->month) {
            $query->where('month', $request->month);
        }

        if ($request->year) {
            $query->where('year', $request->year);
        }

        if ($request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }

        $payrolls = $query->latest()->get();
        $totalPaid = $payrolls->sum('net_salary');

        return view('payroll_history.index', compact('payrolls', 'employees', 'totalPaid'));
    }
}