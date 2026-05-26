<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceApiController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')
            ->latest()
            ->get();

        return response()->json($attendances);
    }

    public function employees()
    {
        $employees = Employee::where('status', 'Active')->get();

        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required',
            'remarks' => 'nullable',
        ]);

        $attendance = Attendance::create($request->all());

        return response()->json([
            'message' => 'Attendance recorded successfully.',
            'attendance' => $attendance,
        ], 201);
    }
}