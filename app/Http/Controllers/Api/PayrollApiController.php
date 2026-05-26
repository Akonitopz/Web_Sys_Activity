<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payroll;

class PayrollApiController extends Controller
{   
    public function index()
    {
        $payrolls = Payroll::with('employee')
            ->latest()
            ->get();

        return response()->json($payrolls);
    }

    public function show($id)
    {
        $payroll = \App\Models\Payroll::with('employee')->findOrFail($id);

        return response()->json($payroll);
    }
}

