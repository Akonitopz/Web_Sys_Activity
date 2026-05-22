<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Payroll Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Employees by Department</h2>

                <canvas id="departmentChart"
                    data-labels='@json($employeesByDepartment->pluck("department"))'
                    data-values='@json($employeesByDepartment->pluck("total"))'>
                </canvas>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Payroll by Month</h2>

                <canvas id="payrollChart"
                    data-labels='@json($payrollByMonth->pluck("month"))'
                    data-values='@json($payrollByMonth->pluck("total"))'>
                </canvas>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('employees.index') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Manage Employees
            </a>

            <a href="{{ route('payrolls.index') }}"
               class="bg-green-500 text-white px-4 py-2 rounded ml-2">
                Manage Payroll
            </a>

            <a href="{{ route('payroll.history') }}"
               class="bg-purple-500 text-white px-4 py-2 rounded ml-2">
                Payroll History
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('audit.logs') }}"
                   class="bg-gray-700 text-white px-4 py-2 rounded ml-2">
                    Audit Logs
                </a>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const departmentChart = document.getElementById('departmentChart');
        const payrollChart = document.getElementById('payrollChart');

        new Chart(departmentChart, {
            type: 'bar',
            data: {
                labels: JSON.parse(departmentChart.dataset.labels),
                datasets: [{
                    label: 'Employees',
                    data: JSON.parse(departmentChart.dataset.values)
                }]
            }
        });

        new Chart(payrollChart, {
            type: 'bar',
            data: {
                labels: JSON.parse(payrollChart.dataset.labels),
                datasets: [{
                    label: 'Total Payroll',
                    data: JSON.parse(payrollChart.dataset.values)
                }]
            }
        });
    </script>
</x-app-layout>