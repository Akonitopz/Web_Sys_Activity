<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Payroll Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded shadow">
                <h2>Total Employees</h2>
                <p class="text-3xl font-bold">{{ $totalEmployees }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2>Payroll Records</h2>
                <p class="text-3xl font-bold">{{ $totalPayrolls }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2>Total Amount Paid</h2>
                <p class="text-3xl font-bold">₱{{ number_format($totalAmountPaid, 2) }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2>Latest Payroll</h2>
                <p class="text-3xl font-bold">
                    {{ $latestPayroll ? $latestPayroll->month . ' ' . $latestPayroll->year : 'None' }}
                </p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('employees.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Manage Employees
            </a>

            <a href="{{ route('payrolls.index') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-2">
                Manage Payroll
            </a>
        </div>
    </div>
</x-app-layout>