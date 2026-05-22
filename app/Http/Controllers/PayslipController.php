<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;

class PayslipController extends Controller
{
    public function show(Payroll $payroll)
    {
        $payroll->load('employee');

        $pdf = Pdf::loadView('payslips.show', compact('payroll'));

        return $pdf->download('payslip-' . $payroll->employee->employee_id . '-' . $payroll->month . '-' . $payroll->year . '.pdf');
    }
}