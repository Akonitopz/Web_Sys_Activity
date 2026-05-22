<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .container { padding: 20px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 8px; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payroll Management System</h1>
        <h2>Employee Payslip</h2>

        <table>
            <tr>
                <th>Employee ID</th>
                <td>{{ $payroll->employee->employee_id }}</td>
            </tr>
            <tr>
                <th>Employee Name</th>
                <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $payroll->employee->department }}</td>
            </tr>
            <tr>
                <th>Payroll Period</th>
                <td>{{ $payroll->month }} {{ $payroll->year }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th>Description</th>
                <th class="right">Amount</th>
            </tr>
            <tr>
                <td>Basic Salary</td>
                <td class="right">PHP {{ number_format($payroll->basic_salary, 2) }}</td>
            </tr>
            <tr>
                <td>Allowance</td>
                <td class="right">PHP {{ number_format($payroll->allowance, 2) }}</td>
            </tr>
            <tr>
                <td>Deduction</td>
                <td class="right">PHP {{ number_format($payroll->deduction, 2) }}</td>
            </tr>
            <tr>
                <td class="bold">Net Salary</td>
                <td class="right bold">PHP {{ number_format($payroll->net_salary, 2) }}</td>
            </tr>
        </table>

        <p style="margin-top: 40px;">
            Generated on: {{ now()->format('F d, Y h:i A') }}
        </p>
    </div>
</body>
</html>