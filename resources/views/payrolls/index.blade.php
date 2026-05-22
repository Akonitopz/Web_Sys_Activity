<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Payroll Records</h1>

        <a href="{{ route('payrolls.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            Process Payroll
        </a>

        @if(session('success'))
            <div class="bg-green-200 p-3 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full mt-6 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Employee</th>
                    <th class="border p-2">Month</th>
                    <th class="border p-2">Year</th>
                    <th class="border p-2">Basic Salary</th>
                    <th class="border p-2">Allowance</th>
                    <th class="border p-2">Deduction</th>
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
                        <td class="border p-2">{{ $payroll->month }}</td>
                        <td class="border p-2">{{ $payroll->year }}</td>
                        <td class="border p-2">{{ $payroll->basic_salary }}</td>
                        <td class="border p-2">{{ $payroll->allowance }}</td>
                        <td class="border p-2">{{ $payroll->deduction }}</td>
                        <td class="border p-2 font-bold">{{ $payroll->net_salary }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>