<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">Payroll History</h1>

        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <select name="employee_id" class="border p-2 rounded">
                <option value="">All Employees</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>

            <select name="month" class="border p-2 rounded">
                <option value="">All Months</option>

                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>

            <input type="number"
                   name="year"
                   placeholder="Year"
                   class="border p-2 rounded">

            <button class="bg-blue-500 text-white rounded px-4 py-2">
                Filter
            </button>
        </form>

        <div class="bg-green-100 p-4 rounded mb-4">
            <strong>Total Paid:</strong>
            ₱{{ number_format($totalPaid, 2) }}
        </div>

        <table class="table-auto w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Employee</th>
                    <th class="border p-2">Month</th>
                    <th class="border p-2">Year</th>
                    <th class="border p-2">Net Salary</th>
                </tr>
            </thead>

            <tbody>
                @foreach($payrolls as $payroll)
                    <tr>
                        <td class="border p-2">
                            {{ $payroll->employee->first_name }}
                            {{ $payroll->employee->last_name }}
                        </td>

                        <td class="border p-2">
                            {{ $payroll->month }}
                        </td>

                        <td class="border p-2">
                            {{ $payroll->year }}
                        </td>

                        <td class="border p-2">
                            ₱{{ number_format($payroll->net_salary, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>