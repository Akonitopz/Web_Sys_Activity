<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->latest()->get();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'Active')->get();
        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required',
            'year' => 'required|integer',
            'allowance' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $employee = Employee::lockForUpdate()->findOrFail($request->employee_id);

                $basicSalary = $employee->salary;
                $allowance = $request->allowance ?? 0;
                $deduction = $request->deduction ?? 0;
                $netSalary = $basicSalary + $allowance - $deduction;

                Payroll::create([
                    'employee_id' => $employee->id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'basic_salary' => $basicSalary,
                    'allowance' => $allowance,
                    'deduction' => $deduction,
                    'net_salary' => $netSalary,
                ]);
            });

            return redirect()->route('payrolls.index')->with('success', 'Payroll processed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Payroll already exists for this employee and period.');
        }
    }
}