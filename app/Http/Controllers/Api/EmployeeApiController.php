<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $employees = Employee::when($search, function ($query, $search) {
            return $query->where('employee_id', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

        return response()->json($employees);
    }

    public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|unique:employees,employee_id',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:employees,email',
        'department' => 'required',
        'salary' => 'required|numeric',
        'status' => 'nullable',
    ]);

    $employee = Employee::create([
        'employee_id' => $request->employee_id,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'department' => $request->department,
        'salary' => $request->salary,
        'status' => $request->status ?? 'Active',
    ]);

    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => 'CREATE',
        'module' => 'Employee',
        'description' => 'Created employee: ' . $employee->first_name . ' ' . $employee->last_name,
    ]);

    return response()->json([
        'message' => 'Employee added successfully.',
        'employee' => $employee,
    ], 201);
}
}